<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Proizvod extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable=['naziv','cena'];
    public $timestamps=false;
}
