<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'content',
        'userid',
        'parent_id'
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }

    // Relasi dengan balasan pesan
    public function replies()
    {
        return $this->hasMany(Message::class, 'parent_id');
    }
}