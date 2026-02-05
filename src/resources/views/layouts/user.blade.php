<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Welcome') - {{ config('app.name', 'Laravel') }}</title>
    
    <!-- Vite CSS & JS Directives -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav>
        <div class="container">
            <a href="/">Home</a>
             @isset($userMenu)
                {{-- This menu would be populated by the ViewServiceProvider --}}
                @foreach ($userMenu as $menu)
                    <a href="{{ $menu->location }}" class="{{ $menu->on === 'Y' ? 'active' : '' }}">
                        {{ $menu->name }}
                    </a>
                @endforeach
            @else
                <a href="#">Features</a>
                <a href="#">Pricing</a>
            @endisset
        </div>
    </nav>

    <div class="container">
        <header class="header">
            <h1>@yield('title', 'Page Title')</h1>
        </header>
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
