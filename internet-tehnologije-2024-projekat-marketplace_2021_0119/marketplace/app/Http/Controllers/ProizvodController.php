<?php

namespace App\Http\Controllers;

use App\Models\Proizvod;
use Illuminate\Http\Request;

class ProizvodController extends Controller
{
    public function index()
    {
        return Proizvod::all();
    }

    public function store(Request $request)
    {
        // Validacija
        $request->validate([
            'naziv' => 'required|string',
            'cena' => 'required|numeric',
            'slika' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        // Čuvanje slike ako postoji
        $slikaPath = null;

        if ($request->hasFile('slika')) {
            $slikaPath = $request->file('slika')->store('proizvodi', 'public');
        }

        // Čuvanje proizvoda
        $proizvod = Proizvod::create([
            'naziv' => $request->naziv,
            'cena' => $request->cena,
            'slika' => $slikaPath,  // ← putanja do slike
        ]);

        return response()->json($proizvod, 201);
    }

    public function show($id)
    {
        return Proizvod::findOrFail($id);
    }

    public function destroy($id)
    {
        $proizvod = Proizvod::findOrFail($id);
        $proizvod->delete();

        return response()->json(['message' => 'Proizvod obrisan']);
    }
}