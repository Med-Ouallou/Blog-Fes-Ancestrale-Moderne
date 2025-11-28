<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $csvPath = database_path('data/articles.csv');

        if (!file_exists($csvPath)) {
            $this->command?->info("CSV not found: {$csvPath}");
            return;
        }

        if (($handle = fopen($csvPath, 'r')) === false) {
            $this->command?->error("Unable to open CSV: {$csvPath}");
            return;
        }

        $header = null;
        while (($row = fgetcsv($handle)) !== false) {
            if ($header === null) {
                $header = $row;
                continue;
            }

            $record = array_combine($header, $row);
            if ($record === false) {
                continue;
            }

            $article = Article::create([
                'title' => $record['title'] ?? '',
                'content' => $record['content'] ?? '',
                'status' => $record['status'] ?? 'draft',
                'user_id' => isset($record['user_id']) ? (int)$record['user_id'] : null,
            ]);

            // Parse category IDs robustly: trim, cast to int and remove empties
            $raw = $record['category_ids'] ?? '';
            $ids = array_filter(array_map('intval', array_map('trim', explode(',', $raw))));

            if (!empty($ids)) {
                // Add categories without detaching existing ones and avoid duplicates
                $article->categories()->syncWithoutDetaching($ids);
            }
        }

        fclose($handle);
    }
}