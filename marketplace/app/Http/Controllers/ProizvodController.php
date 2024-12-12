<?php

namespace App\Http\Controllers;

use App\Models\Proizvod;
use App\Http\Requests\StoreProizvodRequest;
use App\Http\Requests\UpdateProizvodRequest;

class ProizvodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Vraća sve proizvode u JSON formatu
        return response()->json(Proizvod::all());
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
    public function store(StoreProizvodRequest $request)
    {
        //validacija podataka
        $validated = $request->validate([
            'naziv' => 'required|string|max:255',
            'cena' => 'required|numeric',
        ]);

        $product = Proizvod::create($validated);
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Proizvod::find($id);

        if (!$product) {
            return response()->json(['error' => 'Proizvod nije pronadjen'], 404);
        }

        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proizvod $proizvod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProizvodRequest $request, Proizvod $proizvod,$id)
    {
        $product = Proizvod::find($id);

        if (!$product) {
            return response()->json(['error' => 'Proizvod nije pronadjen'], 404);
        }

        // Validacija podataka
        $validated = $request->validate([
            'naziv' => 'required|string|max:255',
            'cena' => 'required|numeric',
        ]);

        $product->update($validated);
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Proizvod::find($id);

        if (!$product) {
            return response()->json(['error' => 'Proizvod nije pronadjen'], 404);
        }

        $product->delete();
        return response()->json(['message' => 'Proizvod uspesno obrisan']);
    }
}
