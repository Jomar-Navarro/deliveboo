<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use Illuminate\Http\Request;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurantId = 10; // ID del ristorante specifico
        $dishes = Dish::where('restaurant_id', $restaurantId)->get();

        return view('admin.dish.index', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Dish.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valData = $request->validate(
            [
                'dish_name' => 'required|string|max:1',
                'description' => 'nullable|string',
                'price' => 'required|numeric|between:0,999.99',
                'is_visible' => 'required|boolean',
                'image_url' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048'
            ],
            [
                'dish_name.required' => 'Il nome del piatto è obbligatorio.',
                'dish_name.string' => 'Il nome del piatto deve essere una stringa.',
                'dish_name.max' => 'Il nome del piatto non può superare i 100 caratteri.',
                'description.string' => 'La descrizione deve essere una stringa.',
                'price.required' => 'Il prezzo è obbligatorio.',
                'price.numeric' => 'Il prezzo deve essere un numero.',
                'price.between' => 'Il prezzo deve essere compreso tra 0 e 999.99.',
                'is_visible.required' => 'Il campo di visibilità è obbligatorio.',
                'is_visible.boolean' => 'Il campo di visibilità deve essere un valore booleano.',
                'image_url.image' => "L'immagine deve essere un file di tipo immagine.",
                'image_url.mimes' => 'L\'immagine deve essere di tipo: jpeg, png, jpg, svg.',
                'image_url.max' => 'L\'immagine non deve superare i 2MB.',
            ]
        );

        // Gestione dell'immagine
        $imageName = time() . '.' . $request->image_url->extension();
        $request->image_url->move(public_path('img'), $imageName);

        // Creazione del nuovo piatto
        $new_dish = new Dish();
        $new_dish->dish_name = $valData['dish_name'];
        $new_dish->description = $valData['description'];
        $new_dish->price = $valData['price'];
        $new_dish->is_visible = $valData['is_visible'];
        $new_dish->image_url = '/img/' . $imageName;

        // Salva il piatto nel database
        $new_dish->save();

        // Redirezione alla pagina di indice dei piatti con un messaggio di successo
        return redirect()->route('admin.dish.index')->with('success', 'Piatto creato con successo.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dish $dish)
    {
        return view('admin.dish.show', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dish $dish)
    {
        return view('admin.Dish.edit', compact('dish'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dish $dish)
    {
        // Validazione dei dati
        $valData = $request->validate(
            [
                'dish_name' => 'required|string|max:100',
                'description' => 'string',
                'price' => 'required|numeric|between:0,999.99',
                'is_visible' => 'required|boolean',
                'image_url' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ],
            [
                'dish_name.required' => 'Il nome del piatto è obbligatorio.',
                'dish_name.string' => 'Il nome del piatto deve essere una stringa.',
                'dish_name.max' => 'Il nome del piatto non può superare i 100 caratteri.',
                'description.string' => 'La descrizione deve essere una stringa.',
                'price.required' => 'Il prezzo è obbligatorio.',
                'price.numeric' => 'Il prezzo deve essere un numero.',
                'price.between' => 'Il prezzo deve essere compreso tra 0 e 999.99.',
                'is_visible.required' => 'Il campo di visibilità è obbligatorio.',
                'is_visible.boolean' => 'Il campo di visibilità deve essere un valore booleano.',
                'image_url.image' => 'L\'immagine deve essere un file di tipo immagine.',
                'image_url.mimes' => 'L\'immagine deve essere nei formati: jpeg, png, jpg, gif, svg.',
                'image_url.max' => 'L\'immagine non può superare i 2MB.'
            ]
        );

        // Aggiornamento del piatto
        $dish->dish_name = $valData['dish_name'];
        $dish->description = $valData['description'];
        $dish->price = $valData['price'];
        $dish->is_visible = $valData['is_visible'];

        // Gestione dell'immagine
        if ($request->hasFile('image_url')) {
            // Rimuovi l'immagine precedente se esiste
            if ($dish->image_url && file_exists(public_path($dish->image_url))) {
                unlink(public_path($dish->image_url));
            }

            $imageName = time() . '.' . $request->image_url->extension();
            $request->image_url->move(public_path('img'), $imageName);
            $dish->image_url = '/img/' . $imageName;
        }

        // Salva le modifiche nel database
        $dish->save();

        // Redirezione alla pagina di dettaglio del piatto con un messaggio di successo
        return redirect()->route('admin.dish.show', $dish->id)->with('success', 'Piatto aggiornato con successo.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {
        $dish->delete();

        return redirect()->route('admin.dish.index')->with('success', 'Piatto eliminato con successo');
    }

    public function restore($id)
    {
        // Trova il piatto con soft delete
        $dish = Dish::withTrashed()->findOrFail($id);

        // Ripristina il piatto
        $dish->restore();

        // Redirezione alla pagina di indice dei piatti con un messaggio di successo
        return redirect()->route('admin.dish.index')->with('success', 'Piatto ripristinato con successo.');
    }

    public function trashed()
    {
        // Ottieni tutti i piatti eliminati
        $trashedDishes = Dish::onlyTrashed()->get();

        // Ritorna la vista con i piatti eliminati
        return view('admin.dish.trashed', compact('trashedDishes'));
    }
}
