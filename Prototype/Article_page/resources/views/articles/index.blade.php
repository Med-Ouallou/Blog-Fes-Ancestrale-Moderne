@extends('layouts.app')

@section('content')

<h1>Articles</h1>

{{-- SUCCESS MESSAGE --}}
@if(session('success'))
    <div style="color: green; font-weight: bold;">
        {{ session('success') }}
    </div>
@endif

{{-- CATEGORY FILTER --}}
<form method="GET" action="{{ route('articles.index') }}">
    <select name="category" onchange="this.form.submit()">
        <option value="">-- All categories --</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ $selectedCategory == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>
</form>

<table border="1" cellpadding="8" width="100%" style="margin-top: 15px;">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Categories</th>
        <th>Status</th>
        <th>Date</th>
        <th>Delete</th>
    </tr>

    @foreach($articles as $article)
    <tr>
        <td>{{ $article->id }}</td>
        <td>{{ $article->title }}</td>
        <td>
            @foreach($article->categories as $cat)
                <span>{{ $cat->name }}</span>
            @endforeach
        </td>
        <td>{{ $article->status }}</td>
        <td>{{ $article->created_at->format('Y-m-d') }}</td>
        <td>
            <form method="POST" action="{{ route('articles.destroy', $article) }}"
                  onsubmit="return confirm('Delete this article?');">
                @csrf
                @method('DELETE')
                <button type="submit" style="color: red;">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

<div style="margin-top: 20px;">
    {{ $articles->links() }}
</div>

@endsection