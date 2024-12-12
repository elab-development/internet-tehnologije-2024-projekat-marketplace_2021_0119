<?php

namespace App\Http\Controllers;

use App\Models\Aukcija;
use App\Http\Requests\StoreAukcijaRequest;
use App\Http\Requests\UpdateAukcijaRequest;

class AukcijaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         // Vraća sve aukcije sa povezanim korisnicima i proizvodima
         $aukcije = Aukcija::with(['korisnik', 'proizvod'])->get();
         return response()->json($aukcije);
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
    public function store(StoreAukcijaRequest $request)
    {
        // Validacija podataka
        $validated = $request->validate([
            'idKorisnik' => 'required|exists:korisniks,id',  // Proverite da korisnik postoji
            'idProizvod' => 'required|exists:proizvods,id',  // Proverite da proizvod postoji
        ]);

        // Kreira aukciju
        $aukcija = Aukcija::create($validated);
        return response()->json($aukcija, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
         // Pronađi aukciju sa povezanim korisnikom i proizvodom
         $aukcija = Aukcija::with(['korisnik', 'proizvod'])->find($id);
        
         if (!$aukcija) {
             return response()->json(['error' => 'Aukcija nije pronađena'], 404);
         }
 
         return response()->json($aukcija);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aukcija $aukcija)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAukcijaRequest $request, Aukcija $aukcija,$id)
    {
        $aukcija = Aukcija::find($id);
        
        if (!$aukcija) {
            return response()->json(['error' => 'Aukcija nije pronađena'], 404);
        }

        // Validacija podataka
        $validated = $request->validate([
            'idKorisnik' => 'required|exists:korisniks,id',
            'idProizvod' => 'required|exists:proizvods,id',
        ]);

        $aukcija->update($validated);
        return response()->json($aukcija);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $aukcija = Aukcija::find($id);
        
        if (!$aukcija) {
            return response()->json(['error' => 'Aukcija nije pronađena'], 404);
        }

        $aukcija->delete();
        return response()->json(['message' => 'Aukcija uspešno obrisana']);
    }
}
