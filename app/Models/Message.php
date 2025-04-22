<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
    ];

    // Tambahkan jika ingin waktu tersimpan otomatis
    public $timestamps = true;

    // Relasi ke pengirim pesan (User)
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Relasi ke penerima pesan (User)
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    // Format waktu otomatis (optional, bisa untuk API atau tampilan)
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];
}
