
<div class="container flex justify-between items-center h-[50px] py-3 font-bold">
    <div>
        <h1>Top Frame Area</h1>
    </div>
    <nav class="flex space-x-4">
        @isset($userMenu)
            @foreach($userMenu as $menu)
                <a href="{{ $menu->location }}" class="text-gray-700 hover:text-blue-500">{{ $menu->name }}</a>
            @endforeach
        @endisset
    </nav>
</div>
