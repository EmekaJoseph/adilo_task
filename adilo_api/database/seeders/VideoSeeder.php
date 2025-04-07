<?php

namespace Database\Seeders;

use App\Models\Video;
use App\Models\User;
use App\Models\Category;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = User::all();
        $categories = Category::all();

        foreach (range(1, 20) as $i) {
            Video::create([
                'title' => "Sample Video $i",
                'description' => "Description for Video $i",
                'url' => "https://example.com/video$i.mp4",
                'user_id' => $users->random()->id,
                'category_id' => $categories->random()->id,
            ]);
        }
    }
}
