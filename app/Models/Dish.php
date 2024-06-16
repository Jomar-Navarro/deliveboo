<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;
    protected $fillable = [
        'dish_name',
        'description',
        'price',
        'is_visible',
        'image_url',
    ];
}
