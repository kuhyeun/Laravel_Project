{{-- 기본 Layout 형성시 필수 Extends --}}
{{-- 기본 Layout 형성시 필수 Extends --}}
@extends( 'layouts.app' )

{{-- 현재 페이지 TITLE 설정 --}}
@section( 'title', 'Welcome Page' )

{{-- Body 구성요소 --}}
@section('content')
    <div id="app" class="w-full h-full p-8 flex flex-col border border-gray-300 p-8 rounded-lg bg-white text-center">
        <landing-page></landing-page>
    </div>
@endsection