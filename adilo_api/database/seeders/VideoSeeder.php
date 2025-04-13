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

        $videoUrls = [
            'https://cdn.pixabay.com/video/2025/04/09/270940_large.mp4',
            'https://cdn.pixabay.com/video/2024/12/15/246856_large.mp4',
            'https://cdn.pixabay.com/video/2025/03/18/265501_large.mp4'
        ];

        foreach (range(1, 20) as $i) {
            Video::create([
                'title' => "Sample Video $i",
                'description' => "This is the description for $i",
                'url' => $videoUrls[array_rand($videoUrls)],
                'user_id' => $users->random()->id,
                'category_id' => $categories->random()->id,
            ]);
        }
    }
}
