<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Mengizinkan akses untuk melihat kategori.
     */
    public function view(User $user, Category $category)
    {
        // Membolehkan admin melihat kategori, atau user biasa jika kategori publik
        return $user->isAdmin() || $category->is_public;
    }

    /**
     * Mengizinkan akses untuk membuat kategori baru.
     */
    public function create(User $user)
    {
        // Hanya admin yang bisa membuat kategori
        return $user->isAdmin();
    }

    /**
     * Mengizinkan akses untuk mengedit kategori.
     */
    public function update(User $user, Category $category)
    {
        // Hanya admin yang bisa mengedit kategori
        return $user->isAdmin();
    }

    /**
     * Mengizinkan akses untuk menghapus kategori.
     */
    public function delete(User $user, Category $category)
    {
        // Hanya admin yang bisa menghapus kategori
        return $user->isAdmin();
    }
}
