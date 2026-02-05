<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel') - {{ config('app.name', 'Laravel') }}</title>
    <!-- CSS and JS assets can be linked here -->
    <style>
        body { display: flex; font-family: sans-serif; }
        .sidebar { width: 220px; background: #2c3e50; color: white; padding: 15px; height: 100vh; }
        .sidebar a { color: white; text-decoration: none; display: block; padding: 10px 15px; }
        .sidebar a.active, .sidebar a:hover { background: #34495e; }
        .content { flex-grow: 1; padding: 20px; }
        .header { border-bottom: 1px solid #ccc; padding-bottom: 15px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>Admin Menu</h3>
        @isset($adminMenu)
            {{-- This menu would be populated by the ViewServiceProvider --}}
            @foreach ($adminMenu as $menu)
                <a href="{{ $menu->location }}" class="{{ $menu->on === 'Y' ? 'active' : '' }}">
                    {{ $menu->name }}
                </a>
            @endforeach
        @else
            <a href="#">Dashboard</a>
            <a href="#">Settings</a>
        @endisset
    </div>
    <div class="content">
        <header class="header">
            <h1>@yield('page_title', 'Dashboard')</h1>
            <p>Welcome, {{ $session->userName ?? 'Admin' }}</p>
        </header>
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
