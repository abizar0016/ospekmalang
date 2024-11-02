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

    // Biarkan ini true untuk auto-incrementing id
    public $incrementing = true;

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

    // Aktifkan pengelolaan timestamps
    public $timestamps = true; // Tambahkan ini

    public function categories()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
