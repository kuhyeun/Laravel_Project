@include('layouts.header')

<div class="container">
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

    <header class="header">
        <h1>@yield('title', 'Page Title')</h1>
    </header>
    <main>
        @yield('content')
    </main>
</div>

@include('layouts.footer')
