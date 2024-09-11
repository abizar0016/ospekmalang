<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth; // Tambahkan ini
use Illuminate\Support\Facades\Log; // Mengimpor kelas Log

class MessageController extends Controller
{

    public function index()
    {
        $currentUser = Auth::user(); // Mendapatkan pengguna yang sedang login
        $messages = Message::with('user', 'replies')->get();
        $users = User::all();


        return view('admin.message', compact('messages', 'users', 'currentUser'));
    }

    public function createMessage(Request $request)
    {
        // Validasi input
        $request->validate([
            'messageName' => 'required|string',
            'messageContent' => 'required|string',
            'messageTarget' => 'required|exists:users,userid', // Validasi tujuan
        ]);
    
        // Buat pesan baru
        $message = new Message();
        $message->name = $request->messageName;
        $message->content = $request->messageContent;
        $message->user_id = $request->messageTarget; // Menyimpan tujuan ke user_id
        $message->save();
    
        // Logging untuk debugging
        Log::info('Message created successfully:', ['message' => $message->toArray()]);
    
        return redirect()->back()->with('success', 'Pesan berhasil ditambahkan.');
    }
    

    public function replyMessage(Request $request, $id)
    {
        // Validasi input balasan
        $request->validate([
            'replyName' => 'required|string',
            'messageContent' => 'required|string',
        ]);
    
        // Ambil pesan yang akan dibalas
        $message = Message::findOrFail($id);
    
        // Buat balasan baru
        $reply = new Message();
        $reply->name = Auth::user()->uname; // Nama pengirim balasan
        $reply->content = $request->replyName;
        $reply->parent_id = $message->id; // Set parent_id ke id pesan yang dibalas
        $reply->user_id = Auth::id(); // User yang membalas
        $reply->save();
    
        // Logging untuk debugging
        Log::info('Message replied successfully:', ['message' => $reply->toArray()]);
    
        return redirect()->back()->with('success', 'Balasan berhasil dikirim.');
    }
    

    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        Log::info('Message deleted successfully:', ['message_id' => $id]);

        return redirect()->back()->with('success', 'Pesan berhasil dihapus');
    }
}
