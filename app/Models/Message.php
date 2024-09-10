<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    // Menentukan nama tabel
    protected $table = 'messages';

    // Menentukan primary key
    protected $primaryKey = 'id';

    // Menentukan bahwa primary key bukan auto-incrementing
    public $incrementing = false;

    // Menentukan tipe data dari primary key
    protected $keyType = 'int';

    // Menentukan atribut yang dapat diisi secara massal
    protected $fillable = [
        'name',
        'content',
        'reply',
        'userid',      // Jika Anda menggunakan kolom userid sebagai foreign key
        'parent_id'    // Jika Anda memiliki kolom parent_id untuk balasan
    ];

    // Menentukan apakah model menggunakan timestamp
    public $timestamps = false;

    // Mendefinisikan relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'userid');
    }

    // Mendefinisikan relasi ke balasan pesan (jika ada)
    public function replies()
    {
        return $this->hasMany(Message::class, 'parent_id', 'id');
    }
}
