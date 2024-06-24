<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DishOrder extends Model
{
    use HasFactory;

    protected $table = 'dish_order';

    protected $fillable = [
        'order_id', 'dish_id', 'quantity'
    ];
}
