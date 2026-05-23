<?php

namespace Database\Seeders;

use App\Models\Certificate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $types = ['course', 'exam', 'competition', 'achievement'];
        $months = ['January', 'February', 'March', 'April', 'May'];

        for ($i = 1; $i <= 15; $i++) {
            $type = $types[array_rand($types)];
            Certificate::create([
                'user_id' => 1,
                'title' => ucfirst($type) . " Certificate #$i",
                'type' => $type,
                'description' => "Successfully completed the requirements for $type level $i.",
                'file_path' => 'certificates/sample.pdf',
                'issue_year' => rand(2024, 2026),
                'issue_month' => $months[array_rand($months)],
            ]);
        }
    }
}
