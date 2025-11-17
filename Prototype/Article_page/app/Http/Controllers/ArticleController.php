<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    public function index()
    {
        $categoryId = request('category');

        $query = Article::with('categories')
            ->orderBy('created_at', 'desc');

        if ($categoryId) {
            $query->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('categories.id', $categoryId);
            });
        }

        $articles = $query->paginate(10)->withQueryString();

        return view('articles.index', [
            'articles' => $articles,
            'categories' => Category::all(),
            'selectedCategory' => $categoryId,
        ]);
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return back()->with('success', 'Article deleted successfully!');
    }
}