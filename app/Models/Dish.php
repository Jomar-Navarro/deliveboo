<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dish extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'dish_name',
        'description',
        'price',
        'is_visible',
        'image_url',
    ];

    protected $dates = ['deleted_at'];
}
