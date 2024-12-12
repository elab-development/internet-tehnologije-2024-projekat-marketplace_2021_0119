<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Korisnik extends Model
{
    use HasFactory;
    public $timestamps=false;
    
    public function aukcija(){
        return $this->hasMany(Aukcija::class,'idKorisnik');
    }

    
    public function kupovina(){
        return $this->hasMany(Kupovina::class,'idKorisnik');
    }
}
