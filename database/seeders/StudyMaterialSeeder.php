<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudyMaterial;
use Illuminate\Support\Facades\DB;

class StudyMaterialSeeder extends Seeder
{
    public function run(): void
    {
        // Purana data clear karein
        DB::table('study_materials')->truncate();

        $materials = [
            // Physics
            [
                'title' => 'Mechanics Fundamentals',
                'subject' => 'physics',
                'type' => 'pdf',
                'target_class' => '11',
                'description' => "Complete guide to Newton's Laws and motion.",
                'file_path' => 'materials/physics_mech.pdf',
                'file_size' => '2.3 MB',
                'page_count' => 24,
            ],
            [
                'title' => 'Thermodynamics Slides',
                'subject' => 'physics',
                'type' => 'ppt',
                'target_class' => '12',
                'description' => 'Interactive slides on heat and energy cycles.',
                'file_path' => 'materials/physics_thermo.ppt',
                'file_size' => '5.7 MB',
                'page_count' => 35,
            ],
            // Chemistry
            [
                'title' => 'Organic Chemistry Vol 1',
                'subject' => 'chemistry',
                'type' => 'notes',
                'target_class' => '11',
                'description' => 'Handwritten notes on carbon compounds and reactions.',
                'file_path' => 'materials/chem_organic.pdf',
                'file_size' => '1.8 MB',
                'page_count' => 18,
            ],
            [
                'title' => 'Chemical Bonding Worksheet',
                'subject' => 'chemistry',
                'type' => 'worksheet',
                'target_class' => '12',
                'description' => 'Practice problems on ionic and covalent bonds.',
                'file_path' => 'materials/chem_bonding.pdf',
                'file_size' => '1.2 MB',
                'page_count' => 12,
            ],
            // Mathematics
            [
                'title' => 'Calculus Formula Sheet',
                'subject' => 'mathematics',
                'type' => 'pdf',
                'target_class' => 'jee',
                'description' => 'Essential formulas for differentiation and integration.',
                'file_path' => 'materials/maths_calculus.pdf',
                'file_size' => '0.9 MB',
                'page_count' => 8,
            ],
            [
                'title' => 'Vectors & 3D Geometry',
                'subject' => 'mathematics',
                'type' => 'ppt',
                'target_class' => '12',
                'description' => 'Complete presentation on vectors for board exams.',
                'file_path' => 'materials/maths_vectors.ppt',
                'file_size' => '6.3 MB',
                'page_count' => 42,
            ],
            // Biology
            [
                'title' => 'Cell Biology Notes',
                'subject' => 'biology',
                'type' => 'notes',
                'target_class' => 'neet',
                'description' => 'Detailed notes on cell structure for NEET aspirants.',
                'file_path' => 'materials/bio_cell.pdf',
                'file_size' => '2.1 MB',
                'page_count' => 22,
            ]
        ];

        foreach ($materials as $material) {
            StudyMaterial::create($material);
        }
    }
}