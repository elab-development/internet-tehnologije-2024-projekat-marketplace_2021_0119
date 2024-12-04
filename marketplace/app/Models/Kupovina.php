<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kupovina extends Model
{
    /** @use HasFactory<\Database\Factories\KupovinaFactory> */
    use HasFactory;

    public $timestamps=false;

    public function korisnik() {

       return $this->belongsTo(Korisnik::class, 'idKorisnik');

    }

    public function proizvod(){
        return $this->belongsTo(Proizvod::class,'id_proizvod');
    }
}
