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