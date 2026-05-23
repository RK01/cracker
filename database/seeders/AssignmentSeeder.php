<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() {
        $subjects = ['Physics', 'Chemistry', 'Mathematics', 'Biology'];
        
        for ($i = 1; $i <= 50; $i++) {
            \App\Models\Assignment::create([
                'title' => $subjects[array_rand($subjects)] . " Assignment #$i",
                'description' => "Complete the chapter exercises and submit the PDF.",
                'subject' => $subjects[array_rand($subjects)],
                'class_level' => 'Class ' . rand(11, 12),
                'due_date' => now()->addDays(rand(-10, 10)),
                'posted_by' => 'Prof. Sharma',
            ]);
        }
    }
}
