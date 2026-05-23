<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $categories = ['engineering', 'medical', 'other'];
        $titles = ['JEE Mains', 'NEET', 'CLAT', 'CA Foundation', 'CUET', 'JEE Advanced'];

        for ($i = 1; $i <= 50; $i++) {
            \App\Models\Course::create([
                'title' => $titles[array_rand($titles)] . " Batch " . $i,
                'subtitle' => 'Comprehensive preparation program',
                'category' => $categories[array_rand($categories)],
                'description' => 'This is a dummy description for course ' . $i,
                'duration' => rand(1, 2) . ' Years',
                'student_count' => rand(100, 1000),
                'rating' => 4.0 + (rand(0, 9) / 10),
                'price' => rand(30000, 80000),
                'discount_price' => rand(20000, 25000),
            ]);
        }
    }
}
