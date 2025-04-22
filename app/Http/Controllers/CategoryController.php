<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function __construct()
    {
        // Hanya batasi method tertentu
        $this->middleware('auth')->except(['index', 'show', 'home', 'popular', 'mostProducts']);
    }

    // Halaman beranda / home
    public function home(Request $request)
    {
        $query = Category::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $categories = $query->withCount('products')->get();
        return view('welcome', compact('categories'));
    }

    // Daftar kategori (publik)
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $categories = $query->withCount('products')->paginate(12);
        return view('categories.index', compact('categories'));
    }

    // Tampilkan detail kategori dan produk-produknya
    public function show($id)
    {
        $category = Category::with('products')->findOrFail($id);
        return view('categories.show', compact('category'));
    }

    // Form tambah kategori
    public function create()
    {
        return view('categories.create');
    }

    // Simpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'image'       => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('category_images', 'public');
            $category->image = $path;
        }

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Form edit kategori
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    // Simpan perubahan kategori
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'image'       => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }

            $path = $request->file('image')->store('category_images', 'public');
            $category->image = $path;
        }

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    // Hapus kategori beserta produknya
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Hapus produk terkait
        $category->products()->delete();

        // Hapus gambar
        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori dan produk terkait berhasil dihapus.');
    }

    // Kategori populer
    public function popular()
    {
        $categories = Category::withCount('products')
            ->orderByDesc('products_count')
            ->paginate(6);

        return view('categories.popular', compact('categories'));
    }

    // Kategori dengan produk terbanyak
    public function mostProducts()
    {
        $categories = Category::withCount('products')
            ->orderByDesc('products_count')
            ->paginate(10);

        return view('categories.most_products', compact('categories'));
    }
}
