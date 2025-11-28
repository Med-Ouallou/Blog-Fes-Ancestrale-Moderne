@extends('layouts.admin')

@section('title', 'Categories - Blog Manager')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-tags text-blue-600 mr-2"></i> Categories
            </h1>
            <a href="{{ route('categories.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                <i class="fas fa-plus mr-2"></i> New Category
            </a>
        </div>

        @if ($categories->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($categories as $category)
                    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $category->name }}</h3>
                        
                        <p class="text-sm text-gray-500 mb-2">
                            <i class="fas fa-link mr-1"></i> Slug: <code class="bg-gray-100 px-2 py-1 rounded">{{ $category->slug }}</code>
                        </p>

                        @if ($category->description)
                            <p class="text-gray-600 mb-4 text-sm leading-relaxed">{{ $category->description }}</p>
                        @else
                            <p class="text-gray-400 text-sm mb-4">No description</p>
                        @endif

                        <p class="text-xs text-gray-500 mb-4">
                            <i class="fas fa-newspaper mr-1"></i> 
                            <strong>{{ $category->articles_count ?? 0 }}</strong> {{ Str::plural('article', $category->articles_count ?? 0) }}
                        </p>

                        <div class="flex gap-2">
                            <a href="{{ route('categories.edit', $category->id) }}" class="flex-1 bg-blue-600 text-white px-3 py-2 rounded-lg hover:bg-blue-700 transition text-center text-sm">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure? This will not delete associated articles.');" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-red-600 text-white px-3 py-2 rounded-lg hover:bg-red-700 transition text-sm">
                                    <i class="fas fa-trash mr-1"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $categories->links('pagination::tailwind') }}
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-inbox text-gray-300 text-6xl mb-4"></i>
                <p class="text-gray-500 text-lg">No categories found. <a href="{{ route('categories.create') }}" class="text-blue-600 hover:text-blue-800 font-medium">Create one now</a></p>
            </div>
        @endif
    </div>
@endsection
