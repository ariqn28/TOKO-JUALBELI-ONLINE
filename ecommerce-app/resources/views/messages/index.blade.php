@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Chat dengan {{ $receiver->name }}</h3>

    <!-- Menampilkan Pesan -->
    <div id="chat-box" class="border p-3 mb-3" style="max-height: 300px; overflow-y: scroll;">
        @foreach ($messages as $msg)
            <div class="{{ $msg->sender_id == auth()->id() ? 'text-end' : 'text-start' }}">
                <div class="d-inline-block p-2 mb-1 rounded {{ $msg->sender_id == auth()->id() ? 'bg-primary text-white' : 'bg-light' }}">
                    {{ $msg->message }}
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">
                        {{ $msg->created_at->format('H:i') }} {{-- Menampilkan waktu --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Form untuk mengirim pesan -->
    <form method="POST" action="{{ route('messages.store', $receiver->id) }}">
        @csrf
        <div class="d-flex">
            <input type="text" name="message" class="form-control me-2" placeholder="Tulis pesan..." required>
            <button type="submit" class="btn btn-primary">Kirim</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Auto-scroll ke bawah saat halaman dimuat
        var chatBox = document.getElementById("chat-box");
        chatBox.scrollTop = chatBox.scrollHeight;

        // Fungsi untuk auto-scroll ke bawah saat pesan baru dikirim
        const scrollToBottom = () => {
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        // SetInterval untuk memeriksa pesan baru
        setInterval(scrollToBottom, 1000); // Update setiap 1 detik
    });
</script>
@endsection
