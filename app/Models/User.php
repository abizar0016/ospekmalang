<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'userid'; // Menyatakan primary key jika bukan 'id'

    public $incrementing = false; // Menyatakan bahwa primary key tidak auto-increment
    
    protected $fillable = [
        'uname',
        'email',
        'password',
    ];  

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
