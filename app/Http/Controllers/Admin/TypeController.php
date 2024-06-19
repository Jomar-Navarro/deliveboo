<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::All();
        return view('admin.type.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255|unique:types,type_name',
            'description' => 'nullable|string',
        ], [
            'type.required' => 'Il campo tipo è obbligatorio.',
            'type.string' => 'Il campo tipo deve essere una stringa.',
            'type.max' => 'Il campo tipo non può superare i 255 caratteri.',
            'type.unique' => 'Questa tipologia è già presente.',
            'description.string' => 'Il campo descrizione deve essere una stringa.',
        ]);

        $newType = new Type();
        $newType->type_name = $request->type;
        $newType->description = $request->description;
        $newType->save();

        return redirect()->route('admin.type.index')->with('success', 'Tipo aggiunto correttamente');
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:types,type_name,'.$id,
            'description' => 'nullable|string',
        ], [
            'name.required' => 'Il campo nome è obbligatorio.',
            'name.string' => 'Il campo nome deve essere una stringa.',
            'name.max' => 'Il campo nome non può superare i 255 caratteri.',
            'name.unique' => 'Questo nome è già in uso.',
            'description.string' => 'Il campo descrizione deve essere una stringa.',
        ]);

        $type = Type::findOrFail($id);
        $type->type_name = $request->name;
        $type->description = $request->description;
        $type->save();

        return redirect()->route('admin.type.index')->with('success', 'Tipo aggiornato correttamente');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $type = Type::findOrFail($id);
        $type->delete();

        return redirect()->route('admin.type.index')->with('success', 'Type eliminata correttamente');
    }
}
