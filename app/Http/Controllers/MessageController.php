<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Menampilkan daftar user selain user yang sedang login
    public function listUsers()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('messages.users', compact('users'));
    }

    // Menampilkan pesan antara pengirim dan penerima
    public function index($receiver_id)
    {
        $receiver = User::findOrFail($receiver_id);

        $messages = Message::where(function ($query) use ($receiver_id) {
            $query->where('sender_id', Auth::id())
                  ->where('receiver_id', $receiver_id);
        })
        ->orWhere(function ($query) use ($receiver_id) {
            $query->where('sender_id', $receiver_id)
                  ->where('receiver_id', Auth::id());
        })
        ->orderBy('created_at')
        ->get();

        return view('messages.index', compact('messages', 'receiver'));
    }

    // Menyimpan pesan baru
    public function store(Request $request, $receiver_id)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $receiver_id,
            'message' => $request->message,
        ]);

        return redirect()->back();
    }
}
