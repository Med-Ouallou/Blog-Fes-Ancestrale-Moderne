<?php

namespace Database\Seeders;
use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $users = User::all();
        Article::factory()->count(20)->make()->each(function($article) use ($users) {
            $article->user_id = $users->random()->id;
            $article->save();
        });
    }
}
