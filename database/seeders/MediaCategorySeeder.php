<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MediaCategory;

class MediaCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            // Photo Categories
            ['name' => 'School Events', 'type' => 'photo', 'status' => 'active', 'created_by' => 'Admin', 'updated_by' => 'Admin'],
            ['name' => 'Sports Activities', 'type' => 'photo', 'status' => 'active', 'created_by' => 'Admin', 'updated_by' => 'Admin'],
            ['name' => 'Academic Achievements', 'type' => 'photo', 'status' => 'active', 'created_by' => 'Admin', 'updated_by' => 'Admin'],
            ['name' => 'Cultural Programs', 'type' => 'photo', 'status' => 'active', 'created_by' => 'Admin', 'updated_by' => 'Admin'],
            ['name' => 'Campus Life', 'type' => 'photo', 'status' => 'active', 'created_by' => 'Admin', 'updated_by' => 'Admin'],
            
            // Video Categories
            ['name' => 'Educational Videos', 'type' => 'video', 'status' => 'active', 'created_by' => 'Admin', 'updated_by' => 'Admin'],
            ['name' => 'Event Recordings', 'type' => 'video', 'status' => 'active', 'created_by' => 'Admin', 'updated_by' => 'Admin'],
            ['name' => 'Student Presentations', 'type' => 'video', 'status' => 'active', 'created_by' => 'Admin', 'updated_by' => 'Admin'],
            ['name' => 'School Tours', 'type' => 'video', 'status' => 'active', 'created_by' => 'Admin', 'updated_by' => 'Admin'],
            ['name' => 'Announcements', 'type' => 'video', 'status' => 'active', 'created_by' => 'Admin', 'updated_by' => 'Admin'],
        ];

        foreach ($categories as $category) {
            MediaCategory::create($category);
        }

        $this->command->info('Media categories created successfully!');
    }
}