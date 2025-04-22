@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-center mb-8 text-blue-600">Produk Saya</h2>

        <div class="text-right mb-6">
            <a href="{{ route('products.create') }}"
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded shadow transition">
                + Tambah Produk
            </a>
        </div>

        @if ($products->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($products as $product)
                    <div class="bg-white rounded-xl shadow hover:shadow-lg transition duration-300 overflow-hidden">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default.jpg') }}"
                             alt="{{ $product->name }}"
                             class="w-full h-48 object-cover">

                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $product->name }}</h3>
                            <p class="text-blue-600 font-bold text-sm mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="text-gray-600 text-sm">{{ Str::limit($product->description, 80) }}</p>

                            <div class="flex justify-between items-center mt-4">
                                <a href="{{ route('products.edit', $product->id) }}"
                                   class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm font-medium shadow">
                                    Edit
                                </a>

                                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm font-medium shadow">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center mt-10">
                <p class="text-gray-500 text-lg">Belum ada produk yang ditambahkan.</p>
                <a href="{{ route('products.create') }}"
                   class="mt-4 inline-block text-blue-600 hover:underline font-medium">
                    Tambah produk pertama Anda
                </a>
            </div>
        @endif
    </div>
@endsection
