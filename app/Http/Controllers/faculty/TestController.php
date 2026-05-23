<?php

namespace App\Http\Controllers\faculty;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseSubCategory;
use App\Models\test\Response;
use Illuminate\Http\Request;
use App\Models\test\Test;
use App\Models\test\Question;
use App\Models\test\Option;
use App\Models\test\Attempt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function test_create()
    {

        $data['courses'] = Course::with('subCategories')->where('id', Auth::user()->course_id)->get();
        $data['courseSubCategory'] = CourseSubCategory::where('course_id', Auth::user()->course_id)->get();
        $data['allTestRecords'] = Test::where('created_by', Auth::user()->id)->get();
        return view('facultyPanel.create-tests', $data);
    }

    public function store(Request $request)
    {
        // 1. Validation
        $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|string',
            'sub_cat_course_id' => 'required',
            'duration_minutes' => 'required|integer',
            'description' => 'required|string',
            'questions' => 'required|array|min:1',
            'questions.*.text' => 'required|string',
            'questions.*.options' => 'required|array|min:4|max:4',
            'questions.*.correct' => 'required',
        ]);

        try {
            DB::beginTransaction();

            // 2. Create Test
            $test = Test::create([
                'title' => $request->title,
                'course_id' => $request->course_id,
                'duration_minutes' => $request->duration_minutes,
                'sub_cat_course_id' => $request->sub_cat_course_id,
                'created_by' => Auth::id(),
                'description' => $request->description,
            ]);

            // 3. Loop through Questions
            foreach ($request->questions as $qData) {
                $question = $test->questions()->create([
                    'question_text' => $qData['text'],
                ]);

                // 4. Loop through Options for this question
                foreach ($qData['options'] as $index => $optionText) {
                    $question->options()->create([
                        'option_text' => $optionText,
                        'is_correct' => $qData['correct'] == $index,
                    ]);
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Test created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function submit(Request $request, $testId)
    {
        $attempt = Attempt::create([
            'user_id' => auth()->id(),
            'test_id' => $testId,
        ]);

        $score = 0;
        foreach ($request->answers as $questionId => $optionId) {
            // Save response
            Response::create([
                'attempt_id' => $attempt->id,
                'question_id' => $questionId,
                'option_id' => $optionId
            ]);

            // Check if correct
            $isCorrect = Option::where('id', $optionId)
                ->where('question_id', $questionId)
                ->where('is_correct', true)
                ->exists();
            if ($isCorrect) $score++;
        }

        $attempt->update(['score' => $score, 'status' => 'completed']);
        return redirect()->route('faculty.result', $attempt->id);
    }

    public function testResult_bkp()
    {
        $tests = CourseSubCategory::with('test.attempts.responses')->where('course_id', Auth::user()->course_id)->get();
        // $tests = CourseSubCategory::with('test.attempts', 'test.questions.options')->where('course_id', Auth::user()->course_id)->get();
        return view('facultyPanel.test.test-result', compact('tests',));
    }

    public function testResult()
    {
        // Eager loading questions and options to prevent N+1 issues
        $tests = CourseSubCategory::with([
            'test' => function ($query) {
               
                $query->where('created_by', Auth::id());
            },
            'test.attempts.responses',
            'test.questions.options'
        ])
            ->where('course_id', Auth::user()->course_id)
            ->whereHas('test', function ($query) {
                $query->where('created_by', Auth::id());
            })
            ->get();

        $stats = [
            'totalTests' => 0,
            'totalQuestions' => 0,
            'totalAttempts' => 0,
            'evaluated' => 0,
        ];

        foreach ($tests as $category) {
            $stats['totalTests'] += $category->test->count();
            foreach ($category->test as $test) {
                $stats['totalQuestions'] += $test->questions->count();
                $stats['totalAttempts'] += $test->attempts->count();
                $stats['evaluated'] += $test->attempts->where('status', 'completed')->count();
            }
        }

        $stats['pending'] = $stats['totalAttempts'] - $stats['evaluated'];
        $stats['progress'] = $stats['totalAttempts'] > 0
            ? round(($stats['evaluated'] / $stats['totalAttempts']) * 100)
            : 0;

        return view('facultyPanel.test.test-result', compact('tests', 'stats'));
    }

    public function show($id)
    {
        $test = Test::with('questions.options')->findOrFail($id);
        return view('facultyPanel.test-view', compact('test'));
    }

    public function showResult($attemptId)
    {
        $attempt = Attempt::findOrFail($attemptId);
        return view('facultyPanel.test-result', compact('attempt'));
    }
}
