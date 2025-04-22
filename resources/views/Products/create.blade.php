@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg">
    <h2 class="text-3xl font-semibold text-center mb-8 text-gray-800">Tambah Produk</h2>
    
    <!-- Menampilkan pesan error jika ada kesalahan input -->
    @if ($errors->any())
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form tambah produk -->
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Nama Produk -->
        <div class="mb-6">
            <label for="name" class="block text-lg font-medium text-gray-800">Nama Produk</label>
            <input type="text" name="name" id="name" class="mt-2 block w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Nama Produk" required>
        </div>

        <!-- Deskripsi Produk -->
        <div class="mb-6">
            <label for="description" class="block text-lg font-medium text-gray-800">Deskripsi Produk</label>
            <textarea name="description" id="description" rows="5" class="mt-2 block w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Deskripsi Produk" required></textarea>
        </div>

        <!-- Kategori Produk -->
        <div class="mb-6">
            <label for="category_id" class="block text-lg font-medium text-gray-800">Kategori</label>
            <select name="category_id" id="category_id" class="mt-2 block w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                <option value="" disabled selected>Pilih Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Harga Produk -->
        <div class="mb-6">
            <label for="price" class="block text-lg font-medium text-gray-800">Harga</label>
            <input type="number" name="price" id="price" class="mt-2 block w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Harga Produk" required>
        </div>

        <!-- Stok Produk -->
        <div class="mb-6">
            <label for="stock" class="block text-lg font-medium text-gray-800">Stok</label>
            <input type="number" name="stock" id="stock" class="mt-2 block w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Jumlah Stok Produk" required>
        </div>

        <!-- Status Produk -->
        <div class="mb-6">
            <label for="status" class="block text-lg font-medium text-gray-800">Kondisi Produk</label>
            <select name="status" id="status" class="mt-2 block w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                <option value="" disabled selected>Pilih Kondisi</option>
                <option value="available">Tersedia</option>
                <option value="out_of_stock">Habis</option>
            </select>
        </div>

        <!-- Gambar Produk -->
        <div class="mb-6">
            <label for="image" class="block text-lg font-medium text-gray-800">Gambar Produk</label>
            <input type="file" name="image" id="image" class="mt-2 block w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Tombol Submit -->
        <div class="mt-8">
            <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Tambah Produk
            </button>
        </div>
    </form>
</div>
@endsection
