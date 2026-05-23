<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\test\Attempt;
use App\Models\test\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class TestController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $purchasesids = $user->purchases()->pluck('course_sub_category_id')->toArray();

        $data['tests'] = Test::with('course', 'questions')->whereIn('sub_cat_course_id', $purchasesids)->where('course_id', $user->course_id)->latest()->get();
        $data['attempts'] = Attempt::where('user_id', $user->id)->get()->keyBy('test_id');
        return view('studentPanel.exams', $data);
    }

    public function start($id)
    {
        $test = Test::with('questions.options')->findOrFail($id);
        return view('studentPanel.test.exams_start', compact('test'));
    }
    public function submit(Request $request, $id)
    {
        $userId = auth()->id();

        $alreadyAttempted = Attempt::where('test_id', $id)
            ->where('user_id', $userId)
            ->first();

        if ($alreadyAttempted) {
            return redirect()
                ->route('student.tests.result', $id);
        }

        $test = Test::with('questions.options')->findOrFail($id);

        $score = 0;
        $total = $test->questions->count();

        // Create Attempt
        $attempt = Attempt::create([
            'user_id'      => $userId,
            'test_id'      => $id,
            'score'        => 0,
            'status'       => 'completed',
            'submitted_at' => now(),
        ]);

        foreach ($test->questions as $question) {

            $selectedOptionId = $request->answers[$question->id] ?? null;

            if ($selectedOptionId) {

                // Save response
                \App\Models\test\Response::create([
                    'attempt_id' => $attempt->id,
                    'question_id' => $question->id,
                    'option_id'  => $selectedOptionId,
                ]);

                // Check correct answer
                $correct = $question->options
                    ->where('is_correct', 1)
                    ->first();

                if ($correct && $correct->id == $selectedOptionId) {
                    $score++;
                }
            }
        }

        // Update score
        $attempt->update([
            'score' => $score
        ]);

        return redirect()
            ->route('student.tests.result', $id);
    }

    public function result($id)
    {
        $user = auth()->user();

        $attempt = Attempt::where('test_id', $id)
            ->where('user_id', $user->id)
            ->with('responses')
            ->firstOrFail();

        $test = Test::with('questions.options')
            ->findOrFail($id);

        return view(
            'studentPanel.test.result',
            compact('test', 'attempt')
        );
    }

    public function downloadPdf($id)
    {
        $user = auth()->user();

        $attempt = Attempt::where('test_id', $id)
            ->where('user_id', $user->id)
            ->with('responses')
            ->firstOrFail();

        $test = Test::with('questions.options')
            ->findOrFail($id);

        $pdf = Pdf::loadView(
            'studentPanel.test.result_pdf',
            compact('test', 'attempt')
        );

        return $pdf->download('OMR-Result.pdf');
    }


    public function submit_bkp(Request $request, $id)
    {
        $userId = auth()->id();
        $alreadyAttempted = Attempt::where('test_id', $id)
            ->where('user_id', $userId)
            ->exists();

        if ($alreadyAttempted) {
            return redirect()
                ->route('student.tests.show', $id)
                ->with('error', 'You have already attempted this test. Retakes are not allowed.');
        }


        $test = Test::with('questions.options')->findOrFail($id);
        $score = 0;
        $total = 0;
        foreach ($test->questions as $question) {
            $total++;
            $selectedOptionId = $request->answers[$question->id] ?? null;
            if ($selectedOptionId) {
                $correct = $question->options->where('is_correct', 1)->first();
                if ($correct && $correct->id == $selectedOptionId) {
                    $score++;
                }
            }
        }
        // Save result
        Attempt::create([
            'test_id' => $id,
            'user_id' => auth()->id(),
            'score' => $score,
            'total' => $total,
        ]);
        return redirect()->route('student.exams')->with('success', "Test submitted! Score: $score / $total");
    }
}
