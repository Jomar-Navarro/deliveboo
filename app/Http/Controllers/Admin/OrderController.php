<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validazione dei dati
        $request->validate([
            'name' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'address' => 'required|string|max:150',
            'postal_code' => 'required|string|max:5',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|string|email|max:100',
            'total_price' => 'required|numeric',
            'dishes' => 'required|array',
            'dishes.*.dish_id' => 'required|exists:dishes,id',
            'dishes.*.quantity' => 'required|integer|min:1'
        ]);

        // Creazione dell'ordine
        $order = Order::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'total_price' => $request->total_price,
        ]);

        // Creazione delle relazioni con i piatti ordinati
        $order->dishes()->attach(
            collect($request->dishes)->mapWithKeys(function ($dish) {
                return [$dish['dish_id'] => ['quantity' => $dish['quantity']]];
            })->toArray()
        );

        return response()->json(['message' => 'Ordine effettuato con successo!', 'order' => $order], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
