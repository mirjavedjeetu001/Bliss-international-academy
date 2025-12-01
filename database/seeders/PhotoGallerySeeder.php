<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PhotoGallery;
use App\Models\MediaCategory;

class PhotoGallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get photo categories
        $photoCategories = MediaCategory::where('type', 'photo')->active()->get();
        
        if ($photoCategories->count() === 0) {
            $this->command->info('No photo categories found. Please create photo categories first.');
            return;
        }

        $samplePhotos = [
            [
                'title' => 'School Annual Day Celebration',
                'category' => 'School Events',
                'status' => 'active'
            ],
            [
                'title' => 'Sports Day Winners',
                'category' => 'Sports Activities',
                'status' => 'active'
            ],
            [
                'title' => 'Science Fair Exhibition',
                'category' => 'Academic Achievements',
                'status' => 'active'
            ],
            [
                'title' => 'Cultural Dance Performance',
                'category' => 'Cultural Programs',
                'status' => 'active'
            ],
            [
                'title' => 'Library Reading Session',
                'category' => 'Campus Life',
                'status' => 'active'
            ],
            [
                'title' => 'Art Competition Winners',
                'category' => 'Academic Achievements',
                'status' => 'active'
            ],
            [
                'title' => 'Basketball Tournament',
                'category' => 'Sports Activities',
                'status' => 'active'
            ],
            [
                'title' => 'Music Concert',
                'category' => 'Cultural Programs',
                'status' => 'active'
            ],
            [
                'title' => 'Computer Lab Session',
                'category' => 'Campus Life',
                'status' => 'active'
            ],
            [
                'title' => 'Graduation Ceremony',
                'category' => 'School Events',
                'status' => 'active'
            ]
        ];

        foreach ($samplePhotos as $photoData) {
            // Find matching category
            $category = $photoCategories->where('name', $photoData['category'])->first();
            
            if ($category) {
                PhotoGallery::create([
                    'title' => $photoData['title'],
                    'image' => 'sample_photo_' . strtolower(str_replace(' ', '_', $photoData['title'])) . '.jpg',
                    'media_category_id' => $category->id,
                    'status' => $photoData['status'],
                    'created_by' => 'Admin',
                    'updated_by' => 'Admin',
                ]);
            }
        }

        $this->command->info('Photo gallery sample data created successfully!');
        $this->command->info('Note: Sample images are placeholders. Upload actual images to replace them.');
    }
}
