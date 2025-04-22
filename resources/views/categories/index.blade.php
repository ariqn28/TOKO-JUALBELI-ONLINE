@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Daftar Kategori</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
        @forelse ($categories as $category)
            <div class="bg-white rounded-lg shadow hover:shadow-md transition duration-300 overflow-hidden">
                <img src="{{ $category->image ? asset('storage/' . $category->image) : asset('images/default-category.png') }}" 
                     alt="{{ $category->name }}" 
                     class="w-full h-32 object-cover">
                <div class="p-3 text-center">
                    <h2 class="text-sm font-semibold">{{ $category->name }}</h2>
                    <p class="text-xs text-gray-600">{{ $category->product_count ?? 0 }} produk</p>
                    <a href="{{ route('categories.show', $category->id) }}" class="text-blue-500 text-xs inline-block mt-1">Lihat Produk</a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-600">Tidak ada kategori.</div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $categories->links() }}
    </div>
</div>
@endsection
