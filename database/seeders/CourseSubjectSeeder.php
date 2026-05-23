<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;

class CourseSubjectSeeder extends Seeder
{
    public function run(): void
    {
        // Purana data delete karein taaki duplicate na ho
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Course::truncate();
        Subject::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. IIT JEE
        $iit_mains = Course::create(['name' => 'IIT JEE', 'sub_category' => 'JEE Mains']);
        $iit_adv = Course::create(['name' => 'IIT JEE', 'sub_category' => 'JEE Advanced']);
        
        $iit_subjects = ['Physics', 'Chemistry', 'Mathematics'];
        foreach([$iit_mains, $iit_adv] as $c) {
            foreach($iit_subjects as $s) { $c->subjects()->create(['name' => $s]); }
        }

        // 2. NEET
        $neet_1 = Course::create(['name' => 'NEET', 'sub_category' => 'Two Year Integrated Course']);
        $neet_2 = Course::create(['name' => 'NEET', 'sub_category' => 'One Year Integrated Course']);
        
        foreach([$neet_1, $neet_2] as $c) {
            foreach(['Physics', 'Chemistry', 'Biology'] as $s) { $c->subjects()->create(['name' => $s]); }
        }

        // 3. CA Foundation
        $ca = Course::create(['name' => 'CA Foundation']);
        foreach(['Accounting', 'Business Laws', 'Quantitative Aptitude', 'Business Economics'] as $s) {
            $ca->subjects()->create(['name' => $s]);
        }

        // 4. CLAT
        $clat = Course::create(['name' => 'CLAT']);
        foreach(['English Language', 'Current Affairs', 'Legal Reasoning', 'Logical Reasoning', 'Quantitative Techniques'] as $s) {
            $clat->subjects()->create(['name' => $s]);
        }

        // 5. CUET (Section II example)
        $cuet_s2 = Course::create(['name' => 'CUET', 'sub_category' => 'Section II – Domain Subjects']);
        $cuet_subjects = [
            ['name' => 'Physics', 'section' => 'Science'],
            ['name' => 'Accountancy', 'section' => 'Commerce'],
            ['name' => 'History', 'section' => 'Humanities'],
            ['name' => 'Legal Studies', 'section' => 'Others']
        ];
        foreach($cuet_subjects as $s) { $cuet_s2->subjects()->create($s); }

        // 6. 12th Dropper
        $dropper = Course::create(['name' => '12th Dropper']);
        $drop_subs = ['Physics', 'Chemistry', 'Mathematics', 'Biology', 'Accountancy', 'Economics', 'Business Studies'];
        foreach($drop_subs as $s) { $dropper->subjects()->create(['name' => $s]); }
    }
}