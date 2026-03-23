{{-- 기본 Layout 형성시 필수 Extends --}}
{{-- 기본 Layout 형성시 필수 Extends --}}
@extends( 'layouts.app' )

{{-- 현재 페이지 TITLE 설정 --}}
@section( 'title', 'Welcome Page' )

{{-- Body 구성요소 --}}
@section('content')
    <div class="flex flex-col justify-center items-center h-full">
        <p class="h-[50px] font-bold">Content Body Area</p>
        <div id="app" class="border border-gray-300 p-8 rounded-lg bg-white text-center">
            <h1 class="text-3xl font-semibold mb-4">Laravel with Vue.js</h1>
            <p class="mb-4 text-gray-500">This part is rendered by Blade.</p>
            <example-component></example-component>
        </div>
    </div>
@endsection