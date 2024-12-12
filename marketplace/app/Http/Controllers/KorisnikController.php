<?php

namespace App\Http\Controllers;

use App\Models\Korisnik;
use App\Http\Requests\StoreKorisnikRequest;
use App\Http\Requests\UpdateKorisnikRequest;
use Illuminate\Support\Facades\Hash;

class KorisnikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         // Vraća listu svih korisnika
         $korisnici = Korisnik::all();
         return response()->json($korisnici);
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
    public function store(StoreKorisnikRequest $request)
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
     * Show the form for editing the specified resource.
     */
    public function edit(Korisnik $korisnik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKorisnikRequest $request, Korisnik $korisnik,$id)
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
