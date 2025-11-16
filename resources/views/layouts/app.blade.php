<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Backlog Games') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    <style>
        body {
            background-color: #0e0f16;
            color: #e6e8f0;
            font-family: 'Inter', sans-serif;
        }

        header {
            background: linear-gradient(90deg, rgba(99, 102, 241, 0.08), transparent 70%);
        }
    </style>
</head>
    <!-- BODY / CUERPO DEL CÓDIGO -->
<body class="font-sans antialiased bg-[#0e0f16] text-gray-100">
    <div class="min-h-screen bg-[#0e0f16]">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
        <header class="border-b border-gray-800 shadow-sm">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex items-center gap-2 text-indigo-400">
                <!-- Puedes usar un ícono o texto -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M5 3a2 2 0 0 0-2 2v3h2V5h3V3H5Zm11 0v2h3v3h2V5a2 2 0 0 0-2-2h-3ZM3 14v5a2 2 0 0 0 2 2h3v-2H5v-5H3Zm16 0v5h-3v2h3a2 2 0 0 0 2-2v-5h-2Z" />
                </svg>
                {{ $header }}
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <main class="bg-[#0e0f16]">
            {{ $slot }}
        </main>
    </div>
</body>

</html>