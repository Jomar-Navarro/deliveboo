<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Type;
use App\Models\Dish;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        $restaurants = Restaurant::with('types', 'dishes')->get();
        return response()->json($restaurants);
    }

        public function type(){
        $types = Type::all();
        return response()->json($types);
    }

}
