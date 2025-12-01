<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MediaCategory;
use App\Models\VideoGallery;

class VideoCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create video categories
        $categories = [
            [
                'name' => 'School Events',
                'type' => 'video',
                'status' => 'active',
                'created_by' => 'Admin',
                'updated_by' => 'Admin',
            ],
            [
                'name' => 'Academic Activities',
                'type' => 'video',
                'status' => 'active',
                'created_by' => 'Admin',
                'updated_by' => 'Admin',
            ],
            [
                'name' => 'Sports & Games',
                'type' => 'video',
                'status' => 'active',
                'created_by' => 'Admin',
                'updated_by' => 'Admin',
            ],
            [
                'name' => 'Cultural Programs',
                'type' => 'video',
                'status' => 'active',
                'created_by' => 'Admin',
                'updated_by' => 'Admin',
            ],
            [
                'name' => 'Student Achievements',
                'type' => 'video',
                'status' => 'active',
                'created_by' => 'Admin',
                'updated_by' => 'Admin',
            ],
        ];

        foreach ($categories as $category) {
            MediaCategory::create($category);
        }

        // Update existing video galleries with categories
        $videoGalleries = VideoGallery::all();
        $categoryIds = MediaCategory::where('type', 'video')->pluck('id')->toArray();

        foreach ($videoGalleries as $index => $video) {
            $categoryId = $categoryIds[$index % count($categoryIds)];
            $video->update(['media_category_id' => $categoryId]);
        }
    }
}
