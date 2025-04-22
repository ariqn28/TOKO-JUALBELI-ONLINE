@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-purple-700">GOLX Marketplace</h1>
        <a href="{{ route('products.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
            + Mulai Jual
        </a>
    </div>

    {{-- Filter Form --}}
    <form method="GET" action="{{ route('products.all') }}" class="flex flex-wrap items-center gap-2 mb-8">
        {{-- Pencarian --}}
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
            class="p-2 border border-gray-300 rounded shadow-sm w-full sm:w-auto flex-grow">

        {{-- Kategori --}}
        <select name="category_id" class="p-2 border border-gray-300 rounded shadow-sm w-full sm:w-auto">
            <option value="">Semua Kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        {{-- Harga Min --}}
        <input type="number" name="min_price" placeholder="Min" value="{{ request('min_price') }}"
            class="p-2 border border-gray-300 rounded shadow-sm w-20">

        {{-- Harga Max --}}
        <input type="number" name="max_price" placeholder="Max" value="{{ request('max_price') }}"
            class="p-2 border border-gray-300 rounded shadow-sm w-20">

        {{-- Status --}}
        <select name="status" class="p-2 border border-gray-300 rounded shadow-sm w-full sm:w-auto">
            <option value="">Semua Kondisi</option>
            <option value="baru" {{ request('status') == 'baru' ? 'selected' : '' }}>Baru</option>
            <option value="bekas" {{ request('status') == 'bekas' ? 'selected' : '' }}>Bekas</option>
        </select>

        {{-- Tombol Filter --}}
        <button type="submit"
            class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded shadow">
            Terapkan Filter
        </button>

        {{-- Tombol Reset --}}
        <a href="{{ route('products.all') }}"
            class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded shadow">
            Reset
        </a>
    </form>

    {{-- Daftar Produk --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($products as $product)
            <a href="{{ route('products.show', $product->id) }}"
                title="{{ $product->name }}"
                class="border rounded-lg shadow hover:shadow-lg transition duration-300 bg-white block">
                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default.png') }}"
                    alt="{{ $product->name }}"
                    class="w-full h-48 object-cover rounded-t-lg">

                <div class="p-4">
                    <h2 class="text-lg font-semibold truncate">{{ $product->name }}</h2>
                    <p class="text-gray-600 text-sm mb-1 truncate">{{ $product->description }}</p>
                    <p class="text-blue-600 font-bold mb-1">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-500 mb-1">Kategori: {{ $product->category->name ?? '-' }}</p>
                    <p class="text-sm text-gray-500 mb-1">Stok: {{ $product->stock }}</p>

                    {{-- Kondisi Badge --}}
                    <span class="inline-block px-2 py-1 rounded bg-gray-200 text-gray-700 text-xs">
                        {{ ucfirst($product->status) }}
                    </span>
                </div>
            </a>
        @empty
            <p class="text-gray-500">Tidak ada produk ditemukan.</p>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-8">
        {{ $products->links() }}
    </div>
</div>
@endsection
