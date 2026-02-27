@include('layouts.header')

<div style="display: flex;">
    @include('layouts.sidebar')

    <div class="content">
        <header class="header">
            <h1>@yield('page_title', 'Dashboard')</h1>
            <p>Welcome, {{ $session->userName ?? 'Admin' }}</p>
        </header>
        <main>
            @yield('content')
        </main>
    </div>
</div>

@include('layouts.footer')