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

        if ($query) {
            $restaurants->where('name', 'LIKE', "%$query%");
        }

        // Filter restaurants that have all selected types
        foreach ($typesArray as $type) {
            $restaurants->whereHas('types', function ($query) use ($type) {
                $query->where('type_name', $type);
            });
        }

        return response()->json($restaurants->get());
    }

    public function menu()
    {
        $menu = Restaurant::with('dishes')->get();
        return response()->json($menu);
    }

}
