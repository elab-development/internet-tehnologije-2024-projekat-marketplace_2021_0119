<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proizvod;

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
    // public function index()
    // {
    //      return Product::all(); // vraca listu svih proizvoda
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) //kreira novi proizvod
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
    public function show(string $id) // vraca pojedinacni proizvod
    {
        $product = Proizvod::find($id);

        if (!$product) {
            return response()->json(['error' => 'Proizvod nije pronadjen'], 404);
        }

        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) //azurira postojeci
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
    public function destroy(string $id) //brise proizvod
    {
        $product = Proizvod::find($id);

        if (!$product) {
            return response()->json(['error' => 'Proizvod nije pronadjen'], 404);
        }

        $product->delete();
        return response()->json(['message' => 'Proizvod uspesno obrisan']);
    }
}
