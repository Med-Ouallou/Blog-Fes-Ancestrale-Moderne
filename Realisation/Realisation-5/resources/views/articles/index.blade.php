@extends('layouts.admin')

@section('title', 'Articles - Blog Manager')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-newspaper text-blue-600 mr-2"></i> Articles
            </h1>
            <a href="{{ route('articles.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                <i class="fas fa-plus mr-2"></i> New Article
            </a>
        </div>

        <!-- Search & Filter Form -->
        <form action="{{ route('articles.index') }}" method="GET" class="bg-gray-50 p-4 rounded-lg mb-6 border border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search by Title -->
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-search mr-2"></i> Search by Title
                    </label>
                    <input 
                        type="text" 
                        name="search" 
                        id="search" 
                        placeholder="Search articles..."
                        value="{{ request('search') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                </div>

                <!-- Filter by Category -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-filter mr-2"></i> Category
                    </label>
                    <select 
                        name="category" 
                        id="category" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter by Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-flag mr-2"></i> Status
                    </label>
                    <select 
                        name="status" 
                        id="status" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                        <option value="">All Status</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>
                            <i class="fas fa-pencil"></i> Draft
                        </option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>
                            <i class="fas fa-check"></i> Published
                        </option>
                    </select>
                    
                </div>
            </div>

            <div class="flex gap-2 mt-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-search mr-2"></i> Search
                </button>
                <a href="{{ route('articles.index') }}" class="bg-gray-400 text-white px-6 py-2 rounded-lg hover:bg-gray-500 transition">
                    <i class="fas fa-redo mr-2"></i> Reset
                </a>
            </div>
        </form>

        <!-- Articles Table -->
        @if ($articles->count())
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">ID</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Title</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Categories</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Status</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Author</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Created</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($articles as $article)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-gray-600">#{{ $article->id }}</td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('articles.show', $article->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                        {{ $article->title }}
                                    </a>
                                </td>
                                <td class="px-4 py-3">
                                    @forelse ($article->categories as $category)
                                        <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mr-1 mb-1">
                                            {{ $category->name }}
                                        </span>
                                    @empty
                                        <span class="text-gray-400 text-sm">No categories</span>
                                    @endforelse
                                </td>
                                <td class="px-4 py-3">
                                    @if ($article->status === 'published')
                                        <span class="inline-block bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full font-semibold">
                                            <i class="fas fa-check-circle mr-1"></i> Published
                                        </span>
                                    @else
                                        <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-3 py-1 rounded-full font-semibold">
                                            <i class="fas fa-pencil-alt mr-1"></i> Draft
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-gray-600">{{ $article->user->name ?? 'Unknown' }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $article->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex gap-2 justify-center">
                                        <a href="{{ route('articles.show', $article->id) }}" class="text-blue-600 hover:text-blue-800 transition" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('articles.edit', $article->id) }}" class="text-yellow-600 hover:text-yellow-800 transition" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this article?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 transition" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $articles->links('pagination::tailwind') }}
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-inbox text-gray-300 text-6xl mb-4"></i>
                <p class="text-gray-500 text-lg">No articles found. <a href="{{ route('articles.create') }}" class="text-blue-600 hover:text-blue-800 font-medium">Create one now</a></p>
            </div>
        @endif
    </div>
@endsection
