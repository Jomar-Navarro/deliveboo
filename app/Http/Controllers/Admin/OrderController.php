<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recupera l'ID del ristorante dell'utente loggato
        $user = Auth::user();
        $restaurant = Restaurant::where('user_id', $user->id)->first();

        if (!$restaurant) {
            abort(404, 'Restaurant not found.');
        }

        // Recupera tutti i piatti del ristorante
        $dishes = $restaurant->dishes;

        // Recupera gli ordini associati ai piatti del ristorante
        $orders = collect();

        foreach ($dishes as $dish) {
            $orders = $orders->merge($dish->orders);
        }

        // Ritorna una vista con la lista degli ordini
        return view('admin.orders.index', compact('orders'));
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
        $valData = $request->validate([
            'name' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'address' => 'required|string|max:150',
            'postal_code' => 'required|string|max:5',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|string|email|max:100',
            'total_price' => 'required|numeric',

            // Validazione per i piatti (dishes) associati
            'dishes' => 'required|array',
            'dishes.*.dish_id' => 'required|exists:dishes,id',
            'dishes.*.quantity' => 'required|integer|min:1'
        ], [
            'name.required' => 'Il nome è obbligatorio.',
            'name.string' => 'Il nome deve essere una stringa.',
            'name.max' => 'Il nome non può superare i 100 caratteri.',
            'lastname.required' => 'Il cognome è obbligatorio.',
            'lastname.string' => 'Il cognome deve essere una stringa.',
            'lastname.max' => 'Il cognome non può superare i 100 caratteri.',
            'address.required' => "L'indirizzo è obbligatorio.",
            'address.string' => "L'indirizzo deve essere una stringa.",
            'address.max' => "L'indirizzo non può superare i 150 caratteri.",
            'postal_code.required' => 'Il CAP è obbligatorio.',
            'postal_code.string' => 'Il CAP deve essere una stringa.',
            'postal_code.max' => 'Il CAP non può superare i 5 caratteri.',
            'phone_number.required' => 'Il numero di telefono è obbligatorio.',
            'phone_number.string' => 'Il numero di telefono deve essere una stringa.',
            'phone_number.max' => 'Il numero di telefono non può superare i 20 caratteri.',
            'email.required' => 'L\'email è obbligatoria.',
            'email.string' => 'L\'email deve essere una stringa.',
            'email.email' => 'L\'email deve essere un indirizzo email valido.',
            'email.max' => 'L\'email non può superare i 100 caratteri.',
            'total_price.required' => 'Il prezzo totale è obbligatorio.',
            'total_price.numeric' => 'Il prezzo totale deve essere numerico.',

            'dishes.required' => 'È necessario selezionare almeno un piatto.',
            'dishes.array' => 'I piatti devono essere un array.',
            'dishes.*.dish_id.required' => 'ID del piatto obbligatorio.',
            'dishes.*.dish_id.exists' => 'Uno o più piatti selezionati non sono validi.',
            'dishes.*.quantity.required' => 'La quantità del piatto è obbligatoria.',
            'dishes.*.quantity.integer' => 'La quantità del piatto deve essere un numero intero.',
            'dishes.*.quantity.min' => 'La quantità del piatto deve essere almeno 1.'
        ]);

        // Creazione dell'ordine
        $order = Order::create([
            'name' => $valData['name'],
            'lastname' => $valData['lastname'],
            'address' => $valData['address'],
            'postal_code' => $valData['postal_code'],
            'phone_number' => $valData['phone_number'],
            'email' => $valData['email'],
            'total_price' => $valData['total_price'],
        ]);

        // Associazione dei piatti (dishes) all'ordine
        foreach ($valData['dishes'] as $dish) {
            $order->dishes()->attach($dish['dish_id'], ['quantity' => $dish['quantity']]);
        }

        return response()->json(['message' => 'Ordine effettuato con successo!', 'order' => $order], 201);
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::with('dishes')->findOrFail($id);
        return view('admin.Orders.show', compact('order'));
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
