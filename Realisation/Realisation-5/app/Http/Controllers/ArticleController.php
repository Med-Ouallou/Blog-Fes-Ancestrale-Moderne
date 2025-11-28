<?php

namespace App\Http\Controllers;

use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * Display a listing of the articles.
     */
    public function index(Request $request)
    {
        $articles = $this->articleService->getArticles($request);
        $categories = $this->articleService->getCategories(); // For filter dropdown

        return view('articles.index', compact('articles', 'categories'));
    }

    /**
     * Show the form for creating a new article.
     */
    public function create()
    {
        $categories = $this->articleService->getCategories();

        return view('articles.create', compact('categories'));
    }

    /**
     * Store a newly created article.
     */
    public function store(Request $request)
    {
        try {
            $this->articleService->createArticle($request);

            return redirect()->route('articles.index')->with('success', 'Article created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified article.
     */
    public function show($id)
    {
        $article = $this->articleService->getArticleById($id);

        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified article.
     */
    public function edit($id)
    {
        $article = $this->articleService->getArticleById($id);
        $categories = $this->articleService->getCategories();

        return view('articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified article.
     */
    public function update(Request $request, $id)
    {
        try {
            $article = \App\Models\Article::findOrFail($id);
            $this->articleService->updateArticle($article, $request);

            return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified article.
     */
    public function destroy($id)
    {
        $article = \App\Models\Article::findOrFail($id);
        $this->articleService->deleteArticle($article);

        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }
}