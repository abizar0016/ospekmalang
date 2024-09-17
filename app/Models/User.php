<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id'; // Ubah sesuai dengan kolom primary key di tabel

    public $incrementing = true; // Primary key adalah auto-incrementing
    
    protected $fillable = [
        'uname',
        'email',
        'password',
        'image', // Pastikan kolom ini juga termasuk jika digunakan
        'status',
        'bio',
        'phone',
        'dob',
        'city',
        'product_id',
        'message_id',
    ];  

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isAdmin()
    {
        // Mengembalikan true jika status pengguna adalah 'admin'
        return $this->status === 'admin';
    }
}
