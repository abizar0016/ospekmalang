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
        $request->validate([
            'messageName' => 'required|string',
            'messageContent' => 'required|string',
            'replyName' => 'nullable|string', // Biarkan nullable jika tidak ada balasan
            'parent_id' => 'nullable|exists:messages,id', // Validasi parent_id jika ada
        ]);

        $message = new Message();
        $message->name = $request->name;

        Log::info('Message created successfully:', ['message' => $message->toArray()]);

        return redirect()->back();
    }

    public function replyMessage($id)
    {
        $users = User::all(); // Mengambil data pengguna    
        $message = Message::findOrFail($id); // Mengambil pesan berdasarkan ID
        
        Log::info('Replying to message:', ['message_id' => $id, 'message' => $message->toArray()]);

        return view('admin.message.reply', [
            'users' => $users,
            'message' => $message
        ]);
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        Log::info('Message deleted successfully:', ['message_id' => $id]);

        return redirect()->back()->with('success', 'Pesan berhasil dihapus');
    }
}
