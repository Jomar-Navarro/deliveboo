<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::with('types', 'dishes')->get();
        return response()->json($restaurants);
    }

    public function type()
    {
        $types = Type::all();
        return response()->json($types);
    }

    public function getFilteredRestaurants(Request $request)
    {
        $types = $request->query('types');
        $query = $request->query('query');

        $typesArray = $types ? explode(',', $types) : [];

        $restaurants = Restaurant::with('types', 'dishes');

        if ($query) {
            $restaurants->where('name', 'LIKE', "%$query%");
        }


        foreach ($typesArray as $type) {
            $restaurants->whereHas('types', function ($query) use ($type) {
                $query->where('type_name', $type);
            });
        }

        return response()->json($restaurants->get());
    }

    public function getDishesById($id)
    {
        $restaurants = Restaurant::where('id', $id)->with('dishes')->first();
        return response()->json($restaurants);
    }
}
