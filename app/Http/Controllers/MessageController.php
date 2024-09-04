<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with('user', 'replies')->get();
        $users = User::all();
        $currentUser = auth()->user(); // Mendapatkan pengguna yang sedang login
        $messageCount = Message::count(); // Hitung jumlah pesan
        return view('admin.message', compact('messages', 'users', 'currentUser', 'messageCount'));
    }
    
    public function createMessage(Request $request)
    {
        $request->validate([
            'messageName' => 'required|string',
            'messageContent' => 'required|string',
            'replyName' => 'nullable|string', // Biarkan nullable jika tidak ada balasan
            'parent_id' => 'nullable|exists:messages,id', // Validasi parent_id jika ada
        ]);

        Message::create([
            'name' => $request->input('messageName'),
            'content' => $request->input('messageContent'),
            'reply' => $request->input('replyName', ''), // Isi dengan string kosong jika tidak ada balasan
            'userid' => auth()->user()->userid,
            'parent_id' => $request->input('parent_id'),
        ]);

        return redirect()->back();
    }


        public function replyMessage($id)
        {
            $users = User::all(); // Mengambil data pengguna    
            $message = Message::findOrFail($id); // Mengambil pesan berdasarkan ID
            return view('admin.message.reply', [
                'users' => $users,
                'message' => $message
            ]);
        }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->back()->with('success', 'Pesan berhasil dihapus');
    }
}
