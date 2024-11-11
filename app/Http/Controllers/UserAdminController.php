<?php
// app/Http/Controllers/UserAdminController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserAdminController extends Controller
{
    public function index(Request $request)
    {
        $users = User::orderBy('id', 'desc')->paginate(5);
        $sessions = $request->session()->get('uname');
        return view('admin.user.index', compact('users', 'sessions'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'uname' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'status' => 'required|in:admin,user',
            'phone' => 'required|string|max:20',
            'dob' => 'required|date',
            'city' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);
    
        // Ambil file gambar dari request
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        } else {
            $imageName = 'images/default-profile.jpg';
        }
    
        $user = new User();
        $user->image = 'images/' . $imageName;
        $user->uname = $request->uname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = $request->status;
        $user->phone = $request->phone;
        $user->dob = $request->dob;
        $user->city = $request->city;
        $user->bio = $request->bio;
        $user->save();
    
        return response()->json(['success' => 'User telah ditambahkan']);
    }

    public function update(Request $request, $id)
    {
        // Temukan pengguna berdasarkan ID
        $user = User::findOrFail($id);
    
        // Validasi data yang diterima
        $request->validate([
            'uname' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'status' => 'required|in:admin,user',
            'phone' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'city' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
        ]);
    
        // Ambil file gambar dari request jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }
    
            // Simpan gambar baru
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $user->image = 'images/' . $imageName;
        }
    
        // Perbarui data pengguna
        $user->uname = $request->uname;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->status = $request->status;
        $user->phone = $request->phone;
        $user->dob = $request->dob;
        $user->city = $request->city;
        $user->bio = $request->bio;
        $user->save();
    
        return response()->json(['success' => 'User telah diperbarui']);
    }

    public function delete(User $id)
    {
        $id->delete();
        return response()->json(['success' => 'User telah dihapus']);
    }
}
