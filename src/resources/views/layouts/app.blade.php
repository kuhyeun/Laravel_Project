<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    {{-- Vite CSS & JS Directives --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col h-screen bg-gray-100">
    {{-- Top Frame --}}
    <header class="border-b">
        @include('frame.topFrame')
    </header>

    {{-- Main Body Container --}}
    <div class="flex flex-1 overflow-hidden">
        {{-- Left Menu --}}
        <aside id="app-sidebar" class="app-sidebar w-[250px] border-r transition-all duration-300 ease-in-out overflow-y-auto overflow-x-hidden">
            @include('frame.leftMenu')
        </aside>

        {{-- Main content area (This will scroll) --}}
        <main id="app-content" class="app-content flex-1 overflow-y-auto p-6 transition-all duration-300 ease-in-out">
            @yield('content')
        </main>
    </div>

    {{-- Bottom Frame --}}
    <footer class="app-footer border-t">
        @include('frame.bottomFrame')
    </footer>
</body>
</html>
