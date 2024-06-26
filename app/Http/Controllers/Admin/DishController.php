<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $restaurant = Restaurant::where('user_id', $user->id)->first();
        $dishes = $restaurant->dishes;

        return view('admin.dish.index', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dish.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valData = $request->validate(
            [
                'dish_name' => 'required|string|max:100',
                'description' => 'nullable|string',
                'price' => 'required|string|max:10',
                'is_visible' => 'required|boolean',
                'image_url' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048'
            ],
            [
                'dish_name.required' => 'Il nome del piatto è obbligatorio.',
                'dish_name.string' => 'Il nome del piatto deve essere una stringa.',
                'dish_name.max' => 'Il nome del piatto non può superare i 100 caratteri.',
                'description.string' => 'La descrizione deve essere una stringa.',
                'price.required' => 'Il prezzo è obbligatorio.',
                'price.max' => 'Il prezzo non deve superare :max caratteri',
                'is_visible.required' => 'Il campo di visibilità è obbligatorio.',
                'is_visible.boolean' => 'Il campo di visibilità deve essere un valore booleano.',
                'image_url.image' => "L'immagine deve essere un file di tipo immagine.",
                'image_url.mimes' => 'L\'immagine deve essere di tipo: jpeg, png, jpg, svg.',
                'image_url.max' => 'L\'immagine non deve superare i 2MB.',
            ]
        );

        if ($request->hasFile('image_url')) {
            // Salva l'immagine nello storage e ottiene il percorso
            $image_path = $request->file('image_url')->store('uploads');

            // Ottiene il nome originale dell'immagine
            $original_name = $request->file('image_url')->getClientOriginalName();
            $valData['image_url'] = $image_path;
            $valData['image_original_name'] = $original_name;
        }

        // Creazione del nuovo piatto
        $new_dish = new Dish();
        $new_dish->dish_name = $valData['dish_name'];
        $new_dish->description = $valData['description'];
        $new_dish->price = $valData['price'];
        $new_dish->is_visible = $valData['is_visible'];
        if (isset($valData['image_url'])) {
            $new_dish->image_url = $valData['image_url'];
        }

        // Associare il piatto al ristorante dell'utente autenticato
        $new_dish->restaurant_id = Auth::user()->restaurant->id;
        $new_dish->save();

        return redirect()->route('admin.dish.index')->with('success', 'Piatto creato con successo.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dish $dish)
    {
        if (Auth::id() != $dish->restaurant->user_id) {
            abort(404);
        }

        return view('admin.dish.show', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dish $dish)
    {
        if (Auth::id() != $dish->restaurant->user_id) {
            abort(404);
        }
        return view('admin.dish.edit', compact('dish'));
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
                'description' => 'nullable|string',
                'price' => 'required|string|max:10',
                'is_visible' => 'required|boolean',
                'image_url' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048'
            ],
            [
                'dish_name.required' => 'Il nome del piatto è obbligatorio.',
                'dish_name.string' => 'Il nome del piatto deve essere una stringa.',
                'dish_name.max' => 'Il nome del piatto non può superare i 100 caratteri.',
                'description.string' => 'La descrizione deve essere una stringa.',
                'price.required' => 'Il prezzo è obbligatorio.',
                'price.max' => 'Il prezzo non deve superare :max caratteri',
                'is_visible.required' => 'Il campo di visibilità è obbligatorio.',
                'is_visible.boolean' => 'Il campo di visibilità deve essere un valore booleano.',
                'image_url.image' => 'L\'immagine deve essere un file di tipo immagine.',
                'image_url.mimes' => 'L\'immagine deve essere nei formati: jpeg, png, jpg, svg.',
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
            if ($dish->image_url) {
                Storage::delete($dish->image_url);
            }

            // Salva la nuova immagine nello storage e ottiene il percorso
            $image_path = $request->file('image_url')->store('uploads');
            $dish->image_url = $image_path;
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
        // Verifica che l'utente autenticato sia il proprietario del ristorante associato al piatto
        if ($dish->restaurant->user_id !== Auth::id()) {
            return redirect()->route('admin.dish.index')->with('error', 'Non hai il permesso per eliminare questo piatto.');
        }

        // Elimina il piatto
        $dish->delete();

        return redirect()->route('admin.dish.index')->with('success', 'Piatto eliminato con successo.');
    }

    public function restore($id)
    {
        // Trova il piatto con soft delete e verifica che appartenga a un ristorante dell'utente autenticato
        $dish = Dish::withTrashed()
            ->where('id', $id)
            ->whereHas('restaurant', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->firstOrFail();

        // Ripristina il piatto
        $dish->restore();

        return redirect()->route('admin.dish.index')->with('success', 'Piatto ripristinato con successo.');
    }

    public function trashed()
    {
        // Ottieni solo i piatti eliminati dei ristoranti dell'utente autenticato
        $trashedDishes = Dish::onlyTrashed()
            ->whereHas('restaurant', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get();

        return view('admin.dish.trashed', compact('trashedDishes'));
    }
}
