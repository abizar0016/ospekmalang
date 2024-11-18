<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_price',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Pastikan foreign key adalah 'user_id'
    }
    
    
    public function orderitem()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function items()
{
    return $this->hasMany(OrderItem::class, 'order_id');
}

}

