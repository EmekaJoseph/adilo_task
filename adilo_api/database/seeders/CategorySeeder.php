<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            ['name' => 'Education'],
            ['name' => 'Entertainment'],
            ['name' => 'Technology'],
            ['name' => 'Sports'],
            ['name' => 'Religion'],
        ]);
    }
}
