<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Tampilkan tampilan user
    public function userView()
    {
        return view('chat.user');
    }

    // Tampilkan tampilan admin (khusus role admin)
    public function adminChat()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return view('chat.admin');
        }
        abort(403, 'Akses ditolak'); // kalau bukan admin
    }

    // Ambil semua pesan
    public function getMessages()
    {
        $messages = Message::orderBy('created_at', 'asc')->get();
        return response()->json($messages);
    }

    // Kirim pesan dari user
    public function sendUser(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        // Bikin token unik per session user
        if (!session()->has('user_token')) {
            session(['user_token' => Str::random(40)]);
        }

        Message::create([
            'sender' => 'user',
            'message' => $request->message,
            'user_token' => session('user_token'),
        ]);

        return response()->json(['status' => 'ok']);
    }

    // Kirim pesan dari admin
    public function sendAdmin(Request $request)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            $request->validate([
                'message' => 'required|string|max:1000'
            ]);

            Message::create([
                'sender' => 'admin',
                'message' => $request->message,
            ]);

            return response()->json(['status' => 'ok']);
        }
        return abort(403, 'Akses ditolak');
    }

    // Hapus pesan (khusus user sendiri)
    public function deleteUserMessage($id)
    {
        $message = Message::findOrFail($id);
        if ($message->sender === 'user' && $message->user_token === session('user_token')) {
            $message->delete();
            return response()->json(['status' => 'deleted']);
        }
        return response()->json(['status' => 'forbidden'], 403);
    }

    // Update pesan (khusus user sendiri)
    public function updateUserMessage(Request $request, $id)
    {
        $message = Message::findOrFail($id);
        if ($message->sender === 'user' && $message->user_token === session('user_token')) {
            $message->message = $request->message;
            $message->save();
            return response()->json(['status' => 'updated']);
        }
        return response()->json(['status' => 'forbidden'], 403);
    }
}
