<?php

namespace App\Http\Controllers\Admin;

use App\Functions\Helper as Help;
use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurant = Restaurant::where('user_id', Auth::id())->get();

        return view('admin.Restaurant.index', compact('restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $types = Type::all();
        $restaurant = Restaurant::where('user_id', Auth::id())->get();
        return view('admin.restaurant.create', compact('types', 'restaurant'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validazione dei dati

        $valData = $request->validate(
            [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'address' => 'required|string|max:255',
                'vat_number' => 'required|string|max:50|unique:restaurants,vat_number',
                'types' => 'nullable|array',
                'types.*' => 'exists:types,id',
            ],
            [
                'name.required' => 'Il nome è obbligatorio.',
                'name.string' => 'Il nome deve essere una stringa.',
                'name.max' => 'Il nome non può superare i 255 caratteri.',
                'description.string' => 'La descrizione deve essere una stringa.',
                'address.required' => "L'indirizzo è obbligatorio.",
                'address.string' => "L'indirizzo deve essere una stringa.",
                'address.max' => "L'indirizzo non può superare i 255 caratteri.",
                'vat_number.required' => 'Il numero di partita IVA è obbligatorio.',
                'vat_number.string' => 'Il numero di partita IVA deve essere una stringa.',
                'vat_number.max' => 'Il numero di partita IVA non può superare i 50 caratteri.',
                'vat_number.unique' => 'Il numero di partita IVA è già in uso.',
                'image.image' => "Il file deve essere un'immagine.",
                'image.mimes' => "L'immagine deve essere nei formati: jpeg, png, jpg, gif, svg.",
                'image.max' => "L'immagine non può superare i 2MB.",
                'types.array' => 'Il campo tipi deve essere un array.',
                'types.*.exists' => 'Uno o più tipi selezionati non sono validi.',
            ]
        );
        // $valData['user_id'] = Auth::id(); //dubbio

        // Gestione dell'immagine
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img'), $imageName);
        } else {
            $imageName = null; // Imposta a null se l'immagine non è fornita
        }

        // Creazione del ristorante
        $new_restaurant = new Restaurant();
        $new_restaurant->name = $valData['name'];
        $new_restaurant->description = $valData['description'];
        $new_restaurant->image = $imageName;
        $new_restaurant->address = $valData['address'];
        $new_restaurant->vat_number = $valData['vat_number'];
        $new_restaurant->slug = Help::generateSlug($request->input('name'), new Restaurant());

        // Salva il ristorante nel database
        $new_restaurant->save();

        if (array_key_exists('types', $valData)) {
            $new_restaurant->types()->sync($valData['types']);
        }

        // Redirezione alla pagina di indice dei ristoranti con un messaggio di successo
        return redirect()->route('admin.restaurant.index')->with('success', 'Ristorante creato con successo.');
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
    public function edit(Restaurant $restaurant)
    {
        $types = Type::all();
        return view('admin.restaurant.edit', compact('restaurant', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        // Validazione dei dati
        $valData = $request->validate(
            [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'address' => 'required|string|max:255',
                'vat_number' => 'required|string|max:50|unique:restaurants,vat_number,' . $restaurant->id,
                'types' => 'nullable|array',
                'types.*' => 'exists:types,id',
            ],
            [
                'name.required' => 'Il nome è obbligatorio.',
                'name.string' => 'Il nome deve essere una stringa.',
                'name.max' => 'Il nome non può superare i 255 caratteri.',
                'description.string' => 'La descrizione deve essere una stringa.',
                'address.required' => "L'indirizzo è obbligatorio.",
                'address.string' => "L'indirizzo deve essere una stringa.",
                'address.max' => "L'indirizzo non può superare i 255 caratteri.",
                'vat_number.required' => 'Il numero di partita IVA è obbligatorio.',
                'vat_number.string' => 'Il numero di partita IVA deve essere una stringa.',
                'vat_number.max' => 'Il numero di partita IVA non può superare i 50 caratteri.',
                'vat_number.unique' => 'Il numero di partita IVA è già in uso.',
                'image.image' => "Il file deve essere un'immagine.",
                'image.mimes' => "L'immagine deve essere nei formati: jpeg, png, jpg, gif, svg.",
                'image.max' => "L'immagine non può superare i 2MB.",
                'types.array' => 'Il campo tipi deve essere un array.',
                'types.*.exists' => 'Uno o più tipi selezionati non sono validi.',
            ]
        );

        // Gestione dell'immagine
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('img'), $imageName);
            $valData['image'] = $imageName;
        }

        // Aggiorna i dati del ristorante
        $restaurant->update($valData);

        // Sincronizza i tipi con il ristorante
        if (array_key_exists('types', $valData)) {
            $restaurant->types()->sync($valData['types']);
        } else {
            $restaurant->types()->sync([]);
        }

        // Redirezione alla pagina di indice dei ristoranti con un messaggio di successo
        return redirect()->route('admin.restaurant.index')->with('success', 'Ristorante aggiornato con successo.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
