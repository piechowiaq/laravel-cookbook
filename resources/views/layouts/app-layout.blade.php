<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Cookbook') }}</title>

    <script defer src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
    <!-- Styles -->
    @stack('styles')
    @livewireStyles


    <style>
        .content a {
            color: blue;
        }

        .content ul {
            list-style-type: disc;
            margin-left: 10px;
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-900">
<div class="min-h-screen bg-gray-100">

    <div class="bg-blue-600 text-white">
        <nav class="container mx-auto px-4 py-4 space-x-6">
            <a href="/" class="hover:text-gray-200">Home</a>
            <a href="/charts" class="hover:text-gray-200">Charts</a>
            <a href="/stats" class="hover:text-gray-200">Stats</a>

        </nav>
    </div>

    <!-- Page Content -->
    <main class="container mx-auto px-4 py-4">
        {{ $slot }}
    </main>
</div>

<!-- Scripts -->
@livewireScripts
@stack('scripts')
</body>

</html>
