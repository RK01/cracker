<?php

namespace Database\Seeders;

use App\Models\Attendance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $subjects = ['Physics', 'Chemistry', 'Mathematics', 'Biology'];
        $startDate = now()->subMonths(6);
        $endDate = now();

        // Loop through each day for the last 6 months
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            // Skip Sundays
            if ($date->dayOfWeek == \Carbon\Carbon::SUNDAY) continue;

            foreach ($subjects as $subject) {
                // Randomly decide status: 90% Present, 10% Absent
                $status = (rand(1, 10) > 1) ? 'present' : 'absent';

                // Randomly make some days Holidays (e.g., 2nd Saturday)
                if ($date->dayOfWeek == \Carbon\Carbon::SATURDAY && $date->day > 7 && $date->day <= 14) {
                    $status = 'holiday';
                }

                Attendance::create([
                    'user_id' => 1, // Logged in user
                    'subject' => $subject,
                    'date' => $date->format('Y-m-d'),
                    'status' => $status
                ]);
            }
        }
    }
}
