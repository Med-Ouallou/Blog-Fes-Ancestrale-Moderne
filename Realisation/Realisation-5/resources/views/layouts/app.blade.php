<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog - Article Management')</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @stack('styles')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<style>
    .ProseMirror:focus {
        outline: none;
    }

    .tiptap ul p,
    .tiptap ol p {
        display: inline;
    }

    .tiptap p.is-editor-empty:first-child::before {
        content: attr(data-placeholder);
        float: left;
        height: 0;
        pointer-events: none;
    }
</style>

<body class="bg-gray-50">

    <!-- Navigation -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo/Brand -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">
                        <i class="fas fa-blog"></i> Blog Manager
                    </a>
                </div>

                <!-- Menu -->
                <div class="flex items-center space-x-8">
                    <a href="{{ route('articles.index') }}" class="text-gray-700 hover:text-blue-600 transition">
                        <i class="fas fa-newspaper"></i> Articles
                    </a>
                    <a href="{{ route('categories.index') }}" class="text-gray-700 hover:text-blue-600 transition">
                        <i class="fas fa-tags"></i> Categories
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Session Messages -->
        @if ($message = session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-sm" role="alert">
            <i class="fas fa-check-circle mr-2"></i>
            {{ $message }}
        </div>
        @endif

        @if ($message = session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg shadow-sm" role="alert">
            <i class="fas fa-exclamation-circle mr-2"></i>
            {{ $message }}
        </div>
        @endif

        <!-- Validation Errors -->
        @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg shadow-sm">
            <h3 class="font-bold mb-2"><i class="fas fa-exclamation-triangle mr-2"></i> Validation Errors:</h3>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Page Content -->
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 mt-12 py-8">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} Blog Management System. All rights reserved.</p>
        </div>
    </footer>

    @stack('scripts')
</body>

</html>