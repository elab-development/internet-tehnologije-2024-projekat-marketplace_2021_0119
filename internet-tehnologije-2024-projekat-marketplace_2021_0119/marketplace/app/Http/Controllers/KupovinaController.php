<?php
namespace App\Http\Controllers;
use App\Models\Kupovina;
use Illuminate\Http\Request;
use App\Http\Requests\StoreKupovinaRequest;
use App\Http\Requests\UpdateKupovinaRequest;

class KupovinaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $kupovine = Kupovina::where('idKorisnik', $user->id)->get();

        return response()->json($kupovine);
    }

    public function create()
    {
        return response()->json(['message' => 'Use store method to create a purchase']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
    $user = $request->user(); // trenutno ulogovani korisnik
    $items = $request->input('items'); // niz proizvoda

    if(!$items || !is_array($items)) {
        return response()->json(['message' => 'No items provided'], 400);
    }

    foreach($items as $item) {
        $idProizvod = $item['id_proizvod'];
        $quantity = $item['quantity'] ?? 1;

       for ($i = 0; $i < $quantity; $i++) {
            Kupovina::create([
                'idKorisnik' => $user->id,
                'id_proizvod' => $idProizvod,
                'datum_kupovine' => now(),
    ]);
}
    }

    return response()->json(['message' => 'Kupovina uspešno izvršena']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Kupovina $kupovina)
    {
        $user = $request->user();

        // Korisnik može videti samo svoje kupovine
        if ($kupovina->idKorisnik !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($kupovina);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kupovina $kupovina)
    {
        return response()->json(['message' => 'Use update method to edit a purchase']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKupovinaRequest $request, Kupovina $kupovina)
    {
        $user = $request->user();

        if ($kupovina->idKorisnik !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $kupovina->update($request->only(['id_proizvod', 'quantity']));

        return response()->json(['message' => 'Kupovina uspešno ažurirana', 'kupovina' => $kupovina]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Kupovina $kupovina)
    {
        $user = $request->user();

        if ($kupovina->idKorisnik !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $kupovina->delete();

        return response()->json(['message' => 'Kupovina uspešno obrisana']);
    }
}
