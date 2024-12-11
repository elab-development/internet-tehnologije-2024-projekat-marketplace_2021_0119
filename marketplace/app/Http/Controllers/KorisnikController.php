<?php

namespace App\Http\Controllers;
    
use App\Models\Korisnik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KorisnikController extends Controller
{
    public function index()
    {
        // Vraća listu svih korisnika
        $korisnici = Korisnik::all();
        return response()->json($korisnici);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validacija podataka
        $validated = $request->validate([
            'ime' => 'required|string|max:255',
            'prezime' => 'required|string|max:255',
            'email' => 'required|email|unique:korisnici,email',
            'password' => 'required|string|min:8',
        ]);

        // Hashiranje lozinke
        $validated['password'] = Hash::make($validated['password']);

        // Kreiranje korisnika
        $korisnik = Korisnik::create($validated);
        return response()->json($korisnik, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Pronaći korisnika po ID-u
        $korisnik = Korisnik::find($id);

        if (!$korisnik) {
            return response()->json(['error' => 'Korisnik nije pronađen'], 404);
        }

        return response()->json($korisnik);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $korisnik = Korisnik::find($id);

        if (!$korisnik) {
            return response()->json(['error' => 'Korisnik nije pronađen'], 404);
        }

        // Validacija podataka
        $validated = $request->validate([
            'ime' => 'required|string|max:255',
            'prezime' => 'required|string|max:255',
            'email' => 'required|email|unique:korisnici,email,' . $id,  // omogući izmenu email-a korisniku sa određenim ID
            'password' => 'nullable|string|min:8',  // Lozinka nije obavezna pri ažuriranju
        ]);

        // Ako je lozinka promenjena, ponovo je hashiramo
        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        // Ažuriramo korisnika
        $korisnik->update($validated);
        return response()->json($korisnik);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $korisnik = Korisnik::find($id);

        if (!$korisnik) {
            return response()->json(['error' => 'Korisnik nije pronađen'], 404);
        }

        // Brisanje korisnika
        $korisnik->delete();
        return response()->json(['message' => 'Korisnik uspešno obrisan']);
    }
}
