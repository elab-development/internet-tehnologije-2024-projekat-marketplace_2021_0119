<?php

namespace App\Http\Controllers;
use App\Models\Aukcija;

use Illuminate\Http\Request;

class AukcijaController extends Controller
{

     // Metoda za prikaz svih aukcija
    public function index()
    {
        // Vraća sve aukcije sa povezanim korisnicima i proizvodima
        $aukcije = Aukcija::with(['korisnik', 'proizvod'])->get();
        return response()->json($aukcije);
    }

    // Metoda za kreiranje nove aukcije
    public function store(Request $request)
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

    // Metoda za prikaz detalja pojedinačne aukcije
    public function show($id)
    {
        // Pronađi aukciju sa povezanim korisnikom i proizvodom
        $aukcija = Aukcija::with(['korisnik', 'proizvod'])->find($id);
        
        if (!$aukcija) {
            return response()->json(['error' => 'Aukcija nije pronađena'], 404);
        }

        return response()->json($aukcija);
    }

    // Metoda za ažuriranje aukcije
    public function update(Request $request, $id)
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

    // Metoda za brisanje aukcije
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
