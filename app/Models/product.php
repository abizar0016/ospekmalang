<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Menentukan nama tabel
    protected $table = 'products';

    // Menentukan primary key
    protected $primaryKey = 'id';

    // Menentukan bahwa primary key bukan auto-incrementing
    public $incrementing = false;

    // Menentukan tipe data dari primary key
    protected $keyType = 'int';

    // Kolom-kolom yang bisa diisi secara massal
    protected $fillable = [
        'name',
        'descriptions',
        'image1',
        'image2',
        'image3',
        'price',
        'stock',
        'category_id',
    ];

    // Kolom yang secara otomatis akan dikelola oleh Eloquent
    public $timestamps = false;

    public function categories()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
