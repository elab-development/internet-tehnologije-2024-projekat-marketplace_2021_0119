<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Kupovina extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps=false;

    public function korisnik() {

       return $this->belongsTo(User::class, 'idKorisnik');

    }

    public function proizvod(){
        return $this->belongsTo(Proizvod::class,'id_proizvod');
    }

}
