<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VideoGallery;

class VideoGallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $videos = [
            [
                'title' => 'Welcome to Bliss International Academy',
                'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'type' => 'youtube',
                'status' => 'active',
                'created_by' => 'Admin',
                'modified_by' => 'Admin',
            ],
            [
                'title' => 'Campus Tour - Satkhira Campus',
                'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'type' => 'youtube',
                'status' => 'active',
                'created_by' => 'Admin',
                'modified_by' => 'Admin',
            ],
            [
                'title' => 'Student Activities and Events',
                'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'type' => 'youtube',
                'status' => 'active',
                'created_by' => 'Admin',
                'modified_by' => 'Admin',
            ],
            [
                'title' => 'Academic Excellence Program',
                'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'type' => 'youtube',
                'status' => 'active',
                'created_by' => 'Admin',
                'modified_by' => 'Admin',
            ],
            [
                'title' => 'Sports Day Highlights',
                'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'type' => 'youtube',
                'status' => 'active',
                'created_by' => 'Admin',
                'modified_by' => 'Admin',
            ],
            [
                'title' => 'Cultural Festival 2024',
                'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'type' => 'youtube',
                'status' => 'active',
                'created_by' => 'Admin',
                'modified_by' => 'Admin',
            ],
            [
                'title' => 'Graduation Ceremony',
                'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'type' => 'youtube',
                'status' => 'active',
                'created_by' => 'Admin',
                'modified_by' => 'Admin',
            ],
            [
                'title' => 'Teacher Training Workshop',
                'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'type' => 'youtube',
                'status' => 'active',
                'created_by' => 'Admin',
                'modified_by' => 'Admin',
            ],
            [
                'title' => 'Parent-Teacher Meeting',
                'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'type' => 'youtube',
                'status' => 'active',
                'created_by' => 'Admin',
                'modified_by' => 'Admin',
            ],
            [
                'title' => 'Science Fair Exhibition',
                'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'type' => 'youtube',
                'status' => 'active',
                'created_by' => 'Admin',
                'modified_by' => 'Admin',
            ],
        ];

        foreach ($videos as $video) {
            VideoGallery::create($video);
        }
    }
}
