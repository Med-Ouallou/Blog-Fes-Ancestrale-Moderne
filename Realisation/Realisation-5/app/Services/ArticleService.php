<?php
namespace App\Services;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ArticleService
{
    /**
     * Get the default admin user.
     *
     * @return User
     * @throws \Exception if no admin user exists
     */
    protected function getDefaultAdmin(): User
    {
        $admin = User::where('role', 'admin')->first();

        if (!$admin) {
            throw new \Exception('No admin user found. Please create an admin user before creating articles.');
        }

        return $admin;
    }

    /**
     * Get paginated articles with filters and search.
     *
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getArticles(Request $request): LengthAwarePaginator
    {
        $query = Article::with(['user', 'categories']);

        // Search on title (and optionally content)
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%"); // Optional: search content, but may be performance-heavy
            });
        }

        // Filter by category
        if ($categoryId = $request->input('category')) {
            $query->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('categories.id', $categoryId);
            });
        }

        // Filter by status (optional)
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        return $query->orderBy('created_at', 'desc')->paginate(10);
    }

    /**
     * Get a single article by ID with relations.
     *
     * @param int $id
     * @return Article
     */
    public function getArticleById(int $id): Article
    {
        return Article::with(['user', 'categories'])->findOrFail($id);
    }

    /**
     * Create a new article.
     *
     * @param Request $request
     * @return Article
     * @throws \Exception if validation or creation fails
     */
    public function createArticle(Request $request): Article
    {
        // Validate input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'categories' => 'nullable|array',
            'categories.*' => 'integer|exists:categories,id',
        ]);

        $admin = $this->getDefaultAdmin();

        $article = Article::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'status' => $validated['status'] ?? 'draft',
            'user_id' => $admin->id,
        ]);

        // Attach categories if provided
        if (!empty($validated['categories'])) {
            $article->categories()->attach($validated['categories']);
        }

        return $article;
    }

    /**
     * Update an existing article.
     *
     * @param Article $article
     * @param Request $request
     * @return Article
     * @throws \Exception if validation fails
     */
    public function updateArticle(Article $article, Request $request): Article
    {
        // Validate input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'categories' => 'nullable|array',
            'categories.*' => 'integer|exists:categories,id',
        ]);

        $article->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'status' => $validated['status'],
        ]);

        // Sync categories if provided
        if (!empty($validated['categories'])) {
            $article->categories()->sync($validated['categories']);
        } else {
            $article->categories()->detach();
        }

        return $article;
    }

    /**
     * Delete an article.
     *
     * @param Article $article
     * @return void
     */
    public function deleteArticle(Article $article): void
    {
        $article->categories()->detach(); // Clean up pivot
        $article->delete();
    }

    /**
     * Get all categories for forms.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCategories()
    {
        return Category::all();
    }
}