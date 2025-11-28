@extends('layouts.app')

@section('title', 'Welcome - Blog Manager')

@section('content')
    <div class="py-12">
        <!-- Hero Section -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold text-gray-800 mb-4">
                <i class="fas fa-blog text-blue-600 mr-2"></i> Welcome to Blog Manager
            </h1>
            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                A powerful, simple article management system with support for rich text editing, 
                categories, search, and filtering. Start creating amazing content today!
            </p>
        </div>

        <!-- Recent Articles Section -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">
                <i class="fas fa-newspaper text-blue-600 mr-2"></i> Recent Articles
            </h2>

            @if($articles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    @foreach($articles as $article)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300 flex flex-col">
                            <!-- Article Header -->
                            <div class="bg-linear-to-r from-blue-500 to-blue-600 p-4 text-white">
                                <h3 class="text-lg font-bold line-clamp-2">{{ $article->title }}</h3>
                            </div>

                            <!-- Article Body -->
                            <div class="p-6 grow flex flex-col">
                                <div class="text-sm text-gray-600 mb-3">
                                    <span><i class="fas fa-calendar mr-1"></i> {{ $article->created_at->format('d M Y') }}</span>
                                    <span class="ml-4"><i class="fas fa-user mr-1"></i> {{ $article->user->name ?? 'Unknown' }}</span>
                                </div>

                                <!-- Categories -->
                                @if($article->categories->count() > 0)
                                    <div class="mb-3 flex flex-wrap gap-2">
                                        @foreach($article->categories as $category)
                                            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">
                                                <i class="fas fa-tag mr-1"></i> {{ $category->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif

                                <!-- Content Preview -->
                                <p class="text-gray-700 text-sm mb-4 grow line-clamp-3">
                                    {{ strip_tags($article->content) }}
                                </p>

                                <!-- Status Badge -->
                                <div class="mb-4">
                                    @if($article->status === 'published')
                                        <span class="inline-block bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full font-semibold">
                                            <i class="fas fa-check-circle mr-1"></i> Published
                                        </span>
                                    @endif
                                </div>

                                <!-- Read More Button -->
                                <a href="{{ route('articles.show', $article->id) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-medium text-center">
                                    <i class="fas fa-arrow-right mr-2"></i> Read Article
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center">
                    <a href="{{ route('articles.index') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                        <i class="fas fa-newspaper mr-2"></i> View All Articles
                    </a>
                </div>
            @else
                <div class="bg-gray-50 rounded-lg shadow-md p-12 text-center">
                    <i class="fas fa-inbox text-gray-400 text-5xl mb-4"></i>
                    <p class="text-gray-600 text-lg mb-6">No published articles yet. Start creating content!</p>
                    <a href="{{ route('articles.create') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-semibold">
                        <i class="fas fa-plus-circle mr-2"></i> Create First Article
                    </a>
                </div>
            @endif
        </div>

        <!-- Quick Action Cards -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">
                <i class="fas fa-rocket text-purple-600 mr-2"></i> Quick Actions
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Articles Card -->
                <div class="bg-linear-to-br from-blue-50 to-blue-100 rounded-lg shadow-md p-6 border-l-4 border-blue-600 hover:shadow-lg transition">
                    <i class="fas fa-newspaper text-blue-600 text-4xl mb-3"></i>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Manage Articles</h3>
                    <p class="text-gray-700 text-sm mb-4">Create, edit, and organize your blog articles with ease.</p>
                    <a href="{{ route('articles.index') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-arrow-right mr-2"></i> View Articles
                    </a>
                </div>

                <!-- Categories Card -->
                <div class="bg-linear-to-br from-green-50 to-green-100 rounded-lg shadow-md p-6 border-l-4 border-green-600 hover:shadow-lg transition">
                    <i class="fas fa-tags text-green-600 text-4xl mb-3"></i>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Organize with Categories</h3>
                    <p class="text-gray-700 text-sm mb-4">Create and manage article categories for better organization.</p>
                    <a href="{{ route('categories.index') }}" class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                        <i class="fas fa-arrow-right mr-2"></i> View Categories
                    </a>
                </div>

                <!-- Create Article Card -->
                <div class="bg-linear-to-br from-purple-50 to-purple-100 rounded-lg shadow-md p-6 border-l-4 border-purple-600 hover:shadow-lg transition">
                    <i class="fas fa-plus-circle text-purple-600 text-4xl mb-3"></i>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Create New Article</h3>
                    <p class="text-gray-700 text-sm mb-4">Start writing your first article with rich text editing.</p>
                    <a href="{{ route('articles.create') }}" class="inline-block bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">
                        <i class="fas fa-arrow-right mr-2"></i> Create Now
                    </a>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <!-- <div class="bg-gray-50 rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Key Features</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-600 mr-3 mt-1 shrink-0"></i>
                    <div>
                        <h4 class="font-bold text-gray-800">Rich Text Editor</h4>
                        <p class="text-gray-600 text-sm">Tiptap WYSIWYG editor for professional article content</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-600 mr-3 mt-1 shrink-0"></i>
                    <div>
                        <h4 class="font-bold text-gray-800">Search & Filter</h4>
                        <p class="text-gray-600 text-sm">Find articles by title, content, category or status</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-600 mr-3 mt-1 shrink-0"></i>
                    <div>
                        <h4 class="font-bold text-gray-800">Category Management</h4>
                        <p class="text-gray-600 text-sm">Organize content with flexible category system</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-600 mr-3 mt-1 shrink-0"></i>
                    <div>
                        <h4 class="font-bold text-gray-800">Responsive Design</h4>
                        <p class="text-gray-600 text-sm">Beautiful on desktop, tablet, and mobile devices</p>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
@endsection
