<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Tampilkan semua produk di marketplace (publik)
     */
    public function allProducts(Request $request)
    {
        $query = Product::with('category', 'user');
        $this->applyFilters($query, $request);

        $products = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('products.marketplace', compact('products', 'categories'));
    }

    /**
     * Tampilkan produk milik user saat ini (dashboard)
     */
    public function myProducts(Request $request)
    {
        $query = Product::with('category')->where('user_id', Auth::id());
        $this->applyFilters($query, $request);

        $products = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Tampilkan detail produk
     */
    public function show(Product $product)
    {
        $this->authorize('view', $product);
        return view('products.show', compact('product'));
    }

    /**
     * Form tambah produk baru
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Simpan produk baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'status'      => 'required|in:available,out_of_stock',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            try {
                $imagePath = $request->file('image')->store('products', 'public');
            } catch (\Exception $e) {
                return back()->withErrors(['image' => 'Gagal upload gambar.']);
            }
        }

        Product::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'status'      => $request->status,
            'category_id' => $request->category_id,
            'user_id'     => Auth::id(),
            'image'       => $imagePath,
        ]);

        return redirect()->route('products.my')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Form edit produk
     */
    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update produk
     */
    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'status'      => 'required|in:available,out_of_stock',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Proses upload gambar jika ada
        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('image')->store('products', 'public');
        }

        // Update data produk
        $product->update([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'status'      => $request->status,
            'category_id' => $request->category_id,
            'image'       => $product->image,
        ]);

        return redirect()->route('products.my')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Hapus produk
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        // Hapus gambar jika ada
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.my')->with('success', 'Produk berhasil dihapus.');
    }

    /**
     * Redirect index ke dashboard
     */
    public function index()
    {
        return redirect()->route('products.my');
    }

    /**
     * Filter produk berdasarkan request
     */
    private function applyFilters($query, Request $request)
    {
        $query->when($request->search, fn($q) => $q->where('name', 'like', '%' . $request->search . '%'))
              ->when($request->category_id, fn($q) => $q->where('category_id', $request->category_id))
              ->when($request->min_price, fn($q) => $q->where('price', '>=', $request->min_price))
              ->when($request->max_price, fn($q) => $q->where('price', '<=', $request->max_price))
              ->when($request->status, fn($q) => $q->where('status', $request->status));
    }

    /**
     * Tampilkan produk berdasarkan kategori (opsional)
     */
    public function byCategory($id, Request $request)
    {
        $query = Product::with('category', 'user')->where('category_id', $id);
        $this->applyFilters($query, $request);

        $products = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('products.marketplace', compact('products', 'categories'));
    }

    /**
     * Tampilkan produk milik user tertentu
     */
    public function showUserProduct($id)
    {
        $product = Product::with('category', 'user')->findOrFail($id);
        return view('products.show-user', compact('product'));
    }
}
