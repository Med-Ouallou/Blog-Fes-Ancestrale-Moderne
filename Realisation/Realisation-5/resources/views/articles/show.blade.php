@extends('layouts.app')

@section('title', $article->title . ' - Blog')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-4xl font-bold text-gray-800 mb-2">{{ $article->title }}</h1>
                <div class="flex gap-4 text-sm text-gray-600">
                    <span><i class="fas fa-user mr-2"></i> By <strong>{{ $article->user->name ?? 'Unknown' }}</strong></span>
                    <span><i class="fas fa-calendar mr-2"></i> {{ $article->created_at->format('d M Y \a\t H:i') }}</span>
                    @if ($article->updated_at != $article->created_at)
                        <span><i class="fas fa-edit mr-2"></i> Updated {{ $article->updated_at->format('d M Y') }}</span>
                    @endif
                </div>
            </div>
            <!-- <div class="flex gap-2">
                <a href="{{ route('articles.edit', $article->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                        <i class="fas fa-trash mr-2"></i> Delete
                    </button>
                </form>
            </div> -->
        </div>

        <!-- Status & Categories -->
        <div class="mb-6 pb-6 border-b border-gray-200">
            <div class="flex flex-wrap gap-4 items-center">
                <div>
                    @if ($article->status === 'published')
                        <span class="inline-block bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full font-semibold">
                            <i class="fas fa-check-circle mr-1"></i> Published
                        </span>
                    @else
                        <span class="inline-block bg-yellow-100 text-yellow-800 text-sm px-3 py-1 rounded-full font-semibold">
                            <i class="fas fa-pencil-alt mr-1"></i> Draft
                        </span>
                    @endif
                </div>

                @if ($article->categories->count())
                    <div>
                        @foreach ($article->categories as $category)
                            <span class="inline-block bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full mr-2">
                                <i class="fas fa-tag mr-1"></i> {{ $category->name }}
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Article Content -->
        <div class="prose prose-lg max-w-none mb-8">
            <div class="text-gray-800 leading-relaxed bg-gray-50 p-6 rounded-lg">
                {!! $article->content !!}
            </div>
        </div>

        <!-- Navigation -->
        <div class="flex gap-4 pt-6 border-t border-gray-200">
            <a href="{{ route('articles.index') }}" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition">
                <i class="fas fa-arrow-left mr-2"></i> Back to Articles
            </a>
        </div>
    </div>
@endsection
