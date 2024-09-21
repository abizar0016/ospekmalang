<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categorys';

    // Define the relationship to the Product model
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
