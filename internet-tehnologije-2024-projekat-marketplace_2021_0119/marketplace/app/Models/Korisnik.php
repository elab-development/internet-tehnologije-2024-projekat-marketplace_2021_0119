<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Korisnik extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    public $timestamps=false;
    protected $fillable=['ime','prezime','email','password'];
    public function aukcija(){
        return $this->hasMany(Aukcija::class,'idKorisnik');
    }

    
    public function kupovina(){
        return $this->hasMany(Kupovina::class,'idKorisnik');
    }
}
