<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Announcement;
use Illuminate\Support\Facades\DB;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        // Purana data clear karne ke liye (Optional)
        // DB::table('announcements')->truncate();

        $categories = ['academic', 'exam', 'event', 'general'];
        $priorities = ['normal', 'high'];
        $posters = ['Academic Coordinator', 'Admin', 'Exam Cell', 'Director'];

        for ($i = 1; $i <= 50; $i++) {
            $cat = $categories[array_rand($categories)];
            
            Announcement::create([
                'title' => "Important Update " . $i . ": " . ucfirst($cat) . " Notification",
                'content' => "This is a dummy announcement content for record number " . $i . ". Please follow the instructions carefully regarding the " . $cat . " department updates.",
                'category' => $cat,
                'priority' => (rand(1, 10) > 8) ? 'high' : 'normal', // 20% High priority records
                'posted_by' => $posters[array_rand($posters)],
                'created_at' => now()->subDays(rand(0, 30)), // Pichle 30 dino ka random data
            ]);
        }
    }
}