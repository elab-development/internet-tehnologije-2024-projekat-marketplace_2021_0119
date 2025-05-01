<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
         // Vraća listu svih korisnika
         $users = User::all();
         return response()->json($users);
    }


    public function store(StoreUserRequest $request)
    {
        // Validacija podataka
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Hashiranje lozinke
        $validated['password'] = Hash::make($validated['password']);

        // Kreiranje korisnika
        $users = User::create($validated);
        return response()->json($users, 201);
    }


    public function show($id)
    {
        // Pronaći korisnika po ID-u
        $users = User::find($id);

        if (!$users) {
            return response()->json(['error' => 'Korisnik nije pronađen'], 404);
        }

        return response()->json($users);
    }


    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user,$id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Korisnik nije pronađen'], 404);
        }

        // Validacija podataka
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:korisnici,email,' . $id,  // omogući izmenu email-a korisniku sa određenim ID
            'password' => 'nullable|string|min:8',  // Lozinka nije obavezna pri ažuriranju
        ]);

        // Ako je lozinka promenjena, ponovo je hashiramo
        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        // Ažuriramo korisnika
        $user->update($validated);
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Korisnik nije pronađen'], 404);
        }

        // Brisanje korisnika
        $user->delete();
        return response()->json(['message' => 'Korisnik uspešno obrisan']);
    }
}
