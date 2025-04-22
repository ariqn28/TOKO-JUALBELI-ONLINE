<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', // pastikan 'role' ada di sini
    ];

    protected $guarded = [];

    /**
     * Menentukan apakah pengguna adalah penjual
     *
     * @return bool
     */
    public function isPenjual()
    {
        return $this->role === 'penjual';
    }

    /**
     * Menentukan apakah pengguna adalah penawar
     *
     * @return bool
     */
    public function isPenawar()
    {
        return $this->role === 'penawar';
    }

    // Relasi ke pesan jika ada
    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }
}
