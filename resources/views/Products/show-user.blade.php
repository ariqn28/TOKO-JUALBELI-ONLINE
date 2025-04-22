@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="row g-0">
            <div class="col-md-5">
                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('default-image.jpg') }}" 
                     class="img-fluid rounded-start" alt="{{ $product->name }}" style="object-fit: cover; height: 100%;">
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <h2 class="card-title text-primary">{{ $product->name }}</h2>
                    <p class="card-text text-muted">{{ $product->description }}</p>
                    <p class="card-text"><strong class="text-success">Rp {{ number_format($product->price, 0, ',', '.') }}</strong></p>
                    <p class="card-text"><strong>Kategori:</strong> {{ $product->category->name ?? '-' }}</p>
                    <p class="card-text"><strong>Stok:</strong> {{ $product->stock }}</p>
                    <p class="card-text"><strong>Penjual:</strong> {{ $product->user->name }}</p>

                    <a href="{{ route('products.my') }}" class="btn btn-secondary mt-3">Kembali ke Produk Saya</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
