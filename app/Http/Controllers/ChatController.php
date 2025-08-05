<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    // Tampilkan tampilan user
    public function userView() {
        return view('chat.user');
    }

    // Tampilkan tampilan admin
    public function adminView() {
        return view('chat.admin');
    }

    // Kirim pesan dari user
    public function sendUser(Request $request) {
        // Buat token unik per user (tanpa login)
        if (!session()->has('user_token')) {
            session(['user_token' => Str::random(40)]);
        }

        Message::create([
            'sender' => 'user',
            'message' => $request->message,
            'user_token' => session('user_token'),
        ]);

        return back();
    }

    // Kirim pesan dari admin
    public function sendAdmin(Request $request) {
        Message::create([
            'sender' => 'admin',
            'message' => $request->message,
        ]);

        return back();
    }

    // Ambil semua pesan (untuk auto-load)
    public function getMessages() {
        $messages = Message::orderBy('created_at')->get();
        return response()->json($messages);
    }

    // Hapus pesan (khusus user sendiri)
    public function deleteUserMessage($id) {
        $message = Message::findOrFail($id);
        if ($message->sender === 'user' && $message->user_token === session('user_token')) {
            $message->delete();
            return response()->json(['status' => 'deleted']);
        }
        return response()->json(['status' => 'forbidden'], 403);
    }

    // Update pesan (khusus user sendiri)
    public function updateUserMessage(Request $request, $id) {
        $message = Message::findOrFail($id);
        if ($message->sender === 'user' && $message->user_token === session('user_token')) {
            $message->message = $request->message;
            $message->save();
            return response()->json(['status' => 'updated']);
        }
        return response()->json(['status' => 'forbidden'], 403);
    }
}
