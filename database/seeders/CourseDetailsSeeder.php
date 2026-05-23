<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Course;

class CourseDetailsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('course_details')->truncate();

        $courses = Course::all();

        foreach ($courses as $course) {

            DB::table('course_details')->insert([
                'course_id' => $course->id,

                'title' => $course->name . ' Full Course',

                'description' => 'Complete preparation course for ' . $course->name,

                'image' => 'assets/img/course.jpg',

                'duration' => rand(6, 12) . ' Months',
                'batch_size' => rand(30, 80),
                'price' => rand(20000, 50000),

                'includes' => json_encode([
                    'Live Classes',
                    'Recorded Videos',
                    'Mock Tests',
                    'Doubt Support'
                ]),

                'highlights' => json_encode([
                    'Expert Faculty',
                    'Weekly Tests',
                    'Performance Analysis'
                ]),

                'syllabus' => json_encode([
                    'Module 1',
                    'Module 2',
                    'Module 3',
                    'Final Revision'
                ]),

                'what_you_get' => json_encode([
                    'PDF Notes',
                    'Practice Questions',
                    'Test Series',
                    'Revision Material'
                ]),

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}