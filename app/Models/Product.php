<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'image',
        'stock',
        'status',
        'user_id'
    ];

    protected $casts = [
        'price' => 'float',
        'stock' => 'integer',
    ];

    /**
     * Relasi ke kategori
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accessor URL gambar produk
     */
    public function getImageUrlAttribute()
    {
        if ($this->image && Storage::disk('public')->exists($this->image)) {
            return asset('storage/' . $this->image);
        }

        return asset('images/default-product.png');
    }

    /**
     * Label status untuk ditampilkan
     */
    public function getStatusLabelAttribute()
    {
        return $this->status === 'baru' ? 'Baru' : 'Bekas';
    }

    /**
     * Deskripsi singkat (opsional)
     */
    public function getShortDescriptionAttribute()
    {
        return Str::limit(strip_tags($this->description), 80);
    }

    /**
     * Validasi data produk
     */
    public static function validateProduct($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'status' => 'required|in:baru,bekas',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);

        return $validator;
    }
}
