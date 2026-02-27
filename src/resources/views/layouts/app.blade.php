<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    {{-- Vite CSS & JS Directives --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="app-layout">
    {{-- Top Frame --}}
    <header class="app-header bg-red-100">
        @include('frame.topFrame')
    </header>

    {{-- Main Body Container --}}
    <div class="app-body">
        {{-- Left Menu --}}
        <aside class="app-sidebar bg-yellow-100">
            @include('frame.leftMenu')
        </aside>

        {{-- Main content area (This will scroll) --}}
        <main class="app-content bg-blue-100">
            @yield('content')
        </main>
    </div>

    {{-- Bottom Frame --}}
    <footer class="app-footer bg-green-100">
        @include('frame.bottomFrame')
    </footer>
</body>
</html>
