<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ParkEasy') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex flex-col items-center justify-center antialiased">

    <!-- Logo -->
    <a href="/" class="flex items-center gap-2 text-2xl font-bold text-teal-600 mb-8">
        <span>🅿</span> ParkEasy
    </a>

    <!-- Card -->
    <div class="w-full max-w-md bg-white rounded-2xl border border-gray-200 shadow-sm p-8">
        {{ $slot }}
    </div>

    <p class="mt-6 text-xs text-gray-400">© {{ date('Y') }} ParkEasy</p>

</body>
</html>