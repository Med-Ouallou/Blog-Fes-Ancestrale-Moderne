<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Technology', 'description' => 'Articles about tech trends and innovations.'],
            ['name' => 'Programming', 'description' => 'Tutorials and tips on coding.'],
            ['name' => 'Laravel', 'description' => 'Specific to Laravel framework.'],
            ['name' => 'Web Development', 'description' => 'General web dev topics.'],
            ['name' => 'Personal Development', 'description' => 'Self-improvement and productivity.'],
        ];

        foreach ($categories as $category) {
            $category['slug'] = $category['slug'] ?? Str::slug($category['name']);
            Category::create($category);
        }
    }
}