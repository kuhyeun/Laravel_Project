@extends('layouts.user')

{{-- @yield('title') 섹션을 'User List'라는 내용으로 채웁니다. --}}
@section('title', 'User List')

{{-- @yield('content') 섹션을 아래 HTML 내용으로 채웁니다. --}}
@section('content')
    <p>This is the list of all users.</p>

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f4f4f4;">
                <th style="padding: 8px 12px; border: 1px solid #ddd;">ID</th>
                <th style="padding: 8px 12px; border: 1px solid #ddd;">Name</th>
                <th style="padding: 8px 12px; border: 1px solid #ddd;">Email</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td style="padding: 8px 12px; border: 1px solid #ddd;">{{ $user->id }}</td>
                    <td style="padding: 8px 12px; border: 1px solid #ddd;">{{ $user->name }}</td>
                    <td style="padding: 8px 12px; border: 1px solid #ddd;">{{ $user->email }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="padding: 8px 12px; border: 1px solid #ddd;">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection