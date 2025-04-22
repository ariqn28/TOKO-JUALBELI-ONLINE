<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'image', 'created_by'];

    /**
     * Relasi ke produk (1 kategori punya banyak produk)
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Relasi ke user yang membuat kategori
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope untuk menghitung jumlah produk per kategori
     */
    public function scopeWithProductCount($query)
    {
        return $query->withCount('products');
    }

    /**
     * Accessor untuk mendapatkan URL gambar kategori
     */
    public function getImageUrlAttribute()
    {
        if ($this->image && Storage::disk('public')->exists($this->image)) {
            return asset('storage/' . $this->image);
        }

        return asset('images/default-category.png');
    }

    /**
     * Validasi data kategori
     */
    public static function validateCategory($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif',
        ]);

        return $validator;
    }

    /**
     * Event untuk membuat slug otomatis saat kategori dibuat
     */
    protected static function booted()
    {
        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }

    /**
     * Mutator untuk menyimpan gambar kategori
     */
    public function setImageAttribute($value)
    {
        if ($value instanceof \Illuminate\Http\UploadedFile) {
            // Jika file diunggah oleh user
            $this->attributes['image'] = $value->store('categories', 'public');
        } else {
            // Jika nilai adalah string (misalnya saat seeding)
            $this->attributes['image'] = $value;
        }
    }
}
