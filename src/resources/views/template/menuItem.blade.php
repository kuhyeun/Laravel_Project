{{-- resources/views/template/menuItem.blade.php --}}
<li class="my-1">
    <div class="flex items-center justify-between p-1 rounded hover:bg-gray-200 @if(isset($menuItem->children) && count($menuItem->children) > 0) menu-toggle cursor-pointer @endif">
        <a href="{{ $menuItem->menu_route_name && Route::has($menuItem->menu_route_name) ? route($menuItem->menu_route_name) : '#' }}" class="flex-grow">
            <span>{{ $menuItem->menu_name }}</span>
        </a>
        @if(isset($menuItem->children) && count($menuItem->children) > 0)
            <span class="icon-wrapper">
                <svg class="w-4 h-4 transform transition-transform duration-300 ease-in-out" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </span>
        @endif
    </div>

    @if(isset($menuItem->children) && count($menuItem->children) > 0)
        <ul class="sub-menu overflow-hidden transition-all duration-300 ease-in-out pl-4 ml-2" style="max-height: 0;">
            @foreach($menuItem->children as $child)
                @include('template.menuItem', ['menuItem' => $child])
            @endforeach
        </ul>
    @endif
</li>
