@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Pengguna yang Bisa Dihubungi</h2>

    <!-- Menampilkan Daftar Pengguna -->
    <ul class="list-group">
        @foreach ($users as $user)
            @if($user->id !== auth()->id()) <!-- Jangan tampilkan user yang sedang login -->
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <!-- Menampilkan nama pengguna dengan link menuju halaman chat -->
                    <a href="{{ route('messages.index', $user->id) }}">
                        {{ $user->name }}
                    </a>

                    <!-- Tautan untuk mulai chat -->
                    <a href="{{ route('messages.index', $user->id) }}" class="btn btn-sm btn-primary">
                        Chat
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</div>
@endsection
