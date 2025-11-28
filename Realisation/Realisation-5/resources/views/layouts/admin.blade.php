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

    <!-- Sidebar -->
    <aside id="sidebar" class="bg-white w-64 border-r border-gray-200 transition-transform duration-300 ease-in-out transform -translate-x-64 lg:translate-x-0 fixed z-50 top-0 left-0 h-screen shadow-lg lg:shadow-md">
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div class="flex items-center gap-2">
                <i class="fas fa-blog text-blue-600 text-2xl"></i>
                <h1 class="text-xl font-bold text-gray-800">Blog Manager</h1>
            </div>
            <button id="closeSidebar" class="lg:hidden text-gray-600 hover:text-gray-800 text-2xl transition">✕</button>
        </div>
        <nav class="p-4 space-y-1 overflow-y-auto" style="max-height: calc(100vh - 120px);">
            <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition font-medium {{ request()->routeIs('home') ? 'bg-blue-100 text-blue-600' : '' }}">
                <i class="fas fa-home w-5"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('articles.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition font-medium {{ request()->routeIs('articles.*') ? 'bg-blue-100 text-blue-600' : '' }}">
                <i class="fas fa-newspaper w-5"></i>
                <span>Articles</span>
            </a>
            <a href="{{ route('categories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition font-medium {{ request()->routeIs('categories.*') ? 'bg-blue-100 text-blue-600' : '' }}">
                <i class="fas fa-tags w-5"></i>
                <span>Categories</span>
            </a>
        </nav>

        <!-- Quick Actions Section -->
        <div class="px-4 py-6 border-t border-gray-100 mt-auto">
            <p class="text-xs uppercase font-semibold text-gray-500 mb-3">Quick Actions</p>
            <div class="space-y-2">
                <a href="{{ route('articles.create') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700 transition font-medium">
                    <i class="fas fa-plus-circle w-4"></i>
                    <span>New Article</span>
                </a>
                <a href="{{ route('categories.create') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg bg-purple-600 text-white hover:bg-purple-700 transition font-medium">
                    <i class="fas fa-plus-circle w-4"></i>
                    <span>New Category</span>
                </a>
            </div>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="lg:ml-64 min-h-screen flex flex-col">
        <!-- Main Content -->
        <main class="flex-1 px-4 sm:px-6 lg:px-8 py-8">
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
            <div class="max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-300 mt-12 py-8">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <p>&copy; {{ date('Y') }} Blog Management System. All rights reserved.</p>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>

<script type="module">
    import {
        Editor
    } from 'https://esm.sh/@tiptap/core@2.11.0';
    import StarterKit from 'https://esm.sh/@tiptap/starter-kit@2.11.0';
    import Placeholder from 'https://esm.sh/@tiptap/extension-placeholder@2.11.0';
    import Paragraph from 'https://esm.sh/@tiptap/extension-paragraph@2.11.0';
    import Bold from 'https://esm.sh/@tiptap/extension-bold@2.11.0';
    import Underline from 'https://esm.sh/@tiptap/extension-underline@2.11.0';
    import Link from 'https://esm.sh/@tiptap/extension-link@2.11.0';
    import BulletList from 'https://esm.sh/@tiptap/extension-bullet-list@2.11.0';
    import OrderedList from 'https://esm.sh/@tiptap/extension-ordered-list@2.11.0';
    import ListItem from 'https://esm.sh/@tiptap/extension-list-item@2.11.0';
    import Blockquote from 'https://esm.sh/@tiptap/extension-blockquote@2.11.0';

    // Helper function to initialize editor
    function initializeEditor(containerId, inputElementId) {
        const container = document.querySelector(`#${containerId}`);
        if (!container) return null;

        const inputElement = document.getElementById(inputElementId);
        const initialContent = inputElement && inputElement.value ? inputElement.value : '';

        const editor = new Editor({
            element: container.querySelector('[data-hs-editor-field]'),
            content: initialContent,
            editorProps: {
                attributes: {
                    class: 'relative min-h-40 p-3'
                }
            },
            extensions: [
                StarterKit.configure({
                    history: false
                }),
                Placeholder.configure({
                    placeholder: 'Add your article content here...',
                    emptyNodeClass: 'before:text-gray-500'
                }),
                Paragraph.configure({
                    HTMLAttributes: {
                        class: 'text-inherit text-gray-800'
                    }
                }),
                Bold.configure({
                    HTMLAttributes: {
                        class: 'font-bold'
                    }
                }),
                Underline,
                Link.configure({
                    HTMLAttributes: {
                        class: 'inline-flex items-center gap-x-1 text-blue-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium'
                    }
                }),
                BulletList.configure({
                    HTMLAttributes: {
                        class: 'list-disc list-inside text-gray-800'
                    }
                }),
                OrderedList.configure({
                    HTMLAttributes: {
                        class: 'list-decimal list-inside text-gray-800'
                    }
                }),
                ListItem.configure({
                    HTMLAttributes: {
                        class: 'marker:text-sm'
                    }
                }),
                Blockquote.configure({
                    HTMLAttributes: {
                        class: 'relative border-s-4 ps-4 sm:ps-6 sm:[&>p]:text-lg'
                    }
                })
            ]
        });

        // Setup button actions
        const actions = [
            {
                selector: `#${containerId} [data-hs-editor-bold]`,
                fn: () => editor.chain().focus().toggleBold().run()
            },
            {
                selector: `#${containerId} [data-hs-editor-italic]`,
                fn: () => editor.chain().focus().toggleItalic().run()
            },
            {
                selector: `#${containerId} [data-hs-editor-underline]`,
                fn: () => editor.chain().focus().toggleUnderline().run()
            },
            {
                selector: `#${containerId} [data-hs-editor-strike]`,
                fn: () => editor.chain().focus().toggleStrike().run()
            },
            {
                selector: `#${containerId} [data-hs-editor-link]`,
                fn: () => {
                    const url = window.prompt('URL');
                    if (url) editor.chain().focus().extendMarkRange('link').setLink({ href: url }).run();
                }
            },
            {
                selector: `#${containerId} [data-hs-editor-ol]`,
                fn: () => editor.chain().focus().toggleOrderedList().run()
            },
            {
                selector: `#${containerId} [data-hs-editor-ul]`,
                fn: () => editor.chain().focus().toggleBulletList().run()
            },
            {
                selector: `#${containerId} [data-hs-editor-blockquote]`,
                fn: () => editor.chain().focus().toggleBlockquote().run()
            },
            {
                selector: `#${containerId} [data-hs-editor-code]`,
                fn: () => editor.chain().focus().toggleCode().run()
            }
        ];

        actions.forEach(({ selector, fn }) => {
            const action = document.querySelector(selector);
            if (action) action.addEventListener('click', fn);
        });

        // Sync content to hidden input on form submit
        const form = container.closest('form');
        if (form) {
            form.addEventListener('submit', () => {
                const inputElement = document.getElementById(inputElementId);
                if (inputElement) inputElement.value = editor.getHTML();
            });
        }

        return editor;
    }

    // Initialize all editors
    initializeEditor('hs-editor-tiptap-create', 'content');
    initializeEditor('hs-editor-tiptap-edit', 'content');
    initializeEditor('hs-editor-tiptap-category-create', 'description');
    initializeEditor('hs-editor-tiptap-category-edit', 'description');
</script>

</html>
