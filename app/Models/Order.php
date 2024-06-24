<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'lastname', 'address', 'postal_code',
        'phone_number', 'email', 'total_price'
    ];


    public function dishes()
    {
        return $this->belongsToMany(Dish::class, 'dish_order')->withPivot('quantity');
    }
}
