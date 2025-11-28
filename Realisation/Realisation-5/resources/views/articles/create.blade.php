@extends('layouts.admin')

@section('title', 'Create Article - Blog Manager')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">
            <i class="fas fa-plus-circle text-green-600 mr-2"></i> Create New Article
        </h1>

        <form action="{{ route('articles.store') }}" method="POST">
            @csrf

            <!-- Title -->
            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-heading mr-2"></i> Title <span class="text-red-600">*</span>
                </label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    value="{{ old('title') }}"
                    placeholder="Enter article title"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror"
                    required
                >
                @error('title')
                    <p class="text-red-600 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                @enderror
            </div>

            <!-- Content with Tiptap -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-pen-fancy mr-2"></i> Content <span class="text-red-600">*</span>
                </label>
                <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                    <div id="hs-editor-tiptap-create">
                        <div class="sticky top-0 bg-white flex align-middle gap-x-0.5 border-b border-gray-200 p-2">
                            <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-bold="">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 12a4 4 0 0 0 0-8H6v8"></path><path d="M15 20a4 4 0 0 0 0-8H6v8Z"></path></svg>
                            </button>
                            <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-italic="">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" x2="10" y1="4" y2="4"></line><line x1="14" x2="5" y1="20" y2="20"></line><line x1="15" x2="9" y1="4" y2="20"></line></svg>
                            </button>
                            <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-underline="">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 4v6a6 6 0 0 0 12 0V4"></path><line x1="4" x2="20" y1="20" y2="20"></line></svg>
                            </button>
                            <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-strike="">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4H9a3 3 0 0 0-2.83 4"></path><path d="M14 12a4 4 0 0 1 0 8H6"></path><line x1="4" x2="20" y1="12" y2="12"></line></svg>
                            </button>
                            <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-link="">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                            </button>
                            <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-ol="">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="10" x2="21" y1="6" y2="6"></line><line x1="10" x2="21" y1="12" y2="12"></line><line x1="10" x2="21" y1="18" y2="18"></line><path d="M4 6h1v4"></path><path d="M4 10h2"></path><path d="M6 18H4c0-1 2-2 2-3s-1-1.5-2-1"></path></svg>
                            </button>
                            <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-ul="">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" x2="21" y1="6" y2="6"></line><line x1="8" x2="21" y1="12" y2="12"></line><line x1="8" x2="21" y1="18" y2="18"></line><line x1="3" x2="3.01" y1="6" y2="6"></line><line x1="3" x2="3.01" y1="12" y2="12"></line><line x1="3" x2="3.01" y1="18" y2="18"></line></svg>
                            </button>
                            <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-blockquote="">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 6H3"></path><path d="M21 12H8"></path><path d="M21 18H8"></path><path d="M3 12v6"></path></svg>
                            </button>
                            <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-code="">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 16 4-4-4-4"></path><path d="m6 8-4 4 4 4"></path><path d="m14.5 4-5 16"></path></svg>
                            </button>
                        </div>
                        <div class="h-40 overflow-auto" data-hs-editor-field=""></div>
                    </div>
                </div>
                <input type="hidden" name="content" id="content" value="{{ old('content') }}">
                @error('content')
                    <p class="text-red-600 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div class="mb-6 mt-4">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-flag mr-2"></i> Status <span class="text-red-600">*</span>
                </label>

                <!-- Card-style radio buttons (match edit page) -->
                <div class="grid sm:grid-cols-2 gap-2">
                    <label class="flex p-3 w-full bg-white border border-gray-200 rounded-lg text-sm focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500">
                        <input
                            type="radio"
                            name="status"
                            value="draft"
                            {{ old('status', 'draft') === 'draft' ? 'checked' : '' }}
                            class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 checked:border-blue-500 mr-3">
                        <div>
                            <div class="text-sm font-medium text-gray-800"><i class="fas fa-pencil-alt mr-1"></i> Draft</div>
                            <div class="text-sm text-gray-500">Save the article as a draft and publish later.</div>
                        </div>
                    </label>

                    <label class="flex p-3 w-full bg-white border border-gray-200 rounded-lg text-sm focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500">
                        <input
                            type="radio"
                            name="status"
                            value="published"
                            {{ old('status') === 'published' ? 'checked' : '' }}
                            class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 checked:border-blue-500 mr-3">
                        <div>
                            <div class="text-sm font-medium text-gray-800"><i class="fas fa-check-circle mr-1"></i> Published</div>
                            <div class="text-sm text-gray-500">Make the article public immediately.</div>
                        </div>
                    </label>
                </div>

                @error('status')
                    <p class="text-red-600 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                @enderror
            </div>

            <!-- Categories -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-tags mr-2"></i> Categories
                </label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 bg-gray-50 p-4 rounded-lg border border-gray-200">
                    @foreach ($categories as $category)
                        <label class="flex items-center cursor-pointer">
                            <input 
                                type="checkbox" 
                                name="categories[]" 
                                value="{{ $category->id }}"
                                {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}
                                class="mr-2 w-4 h-4"
                            >
                            <span class="text-gray-700">{{ $category->name }}</span>
                        </label>
                    @endforeach
                </div>
                @if ($categories->isEmpty())
                    <p class="text-gray-500 text-sm mt-2">
                        <i class="fas fa-info-circle mr-1"></i> No categories available. 
                        <a href="{{ route('categories.create') }}" class="text-blue-600 hover:text-blue-800 font-medium">Create one</a>
                    </p>
                @endif
                @error('categories')
                    <p class="text-red-600 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex gap-4">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition font-semibold">
                    <i class="fas fa-save mr-2"></i> Create Article
                </button>
                <a href="{{ route('articles.index') }}" class="bg-gray-400 text-white px-6 py-2 rounded-lg hover:bg-gray-500 transition">
                    <i class="fas fa-times mr-2"></i> Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
