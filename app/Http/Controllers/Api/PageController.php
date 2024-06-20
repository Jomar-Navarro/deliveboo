<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

        if (count($typesArray) > 0) {
            $restaurants = $restaurants->whereHas('types', function ($q) use ($typesArray) {
                $q->whereIn('type_name', $typesArray);
            });
        }

        if ($query) {
            $restaurants = $restaurants->where('name', 'LIKE', "%$query%");
        }

        return response()->json($restaurants->get());
    }
}
