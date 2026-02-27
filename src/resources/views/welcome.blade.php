{{-- 기본 Layout 형성시 필수 Extends --}}
@extends( 'layouts.app' )

{{-- 현재 페이지 TITLE 설정 --}}
@section( 'title', 'Welcome Page' )

{{-- Body 구성요소 --}}
@section('content')
    <body class="font-sans antialiased">
        <div class="bg-blue-200" style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%;">
            <p class="h-[50px] font-bold">Content Body Area</p>
            <div id="app" style="border: 1px solid #d1d5db; padding: 2rem; border-radius: 0.5rem; background-color: #ffffff; text-align: center;">
                <h1 style="font-size: 1.875rem; font-weight: 600; margin-bottom: 1rem;">Laravel with Vue.js</h1>
                <p style="margin-bottom: 1rem; color: #6b7280;">This part is rendered by Blade.</p>
                <example-component></example-component>
            </div>
        </div>
    </body>
@endsection