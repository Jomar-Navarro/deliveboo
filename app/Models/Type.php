<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_name',
        'description'
    ];

    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class);
    }
}
