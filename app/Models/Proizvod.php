<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proizvod extends Model
{
    /** @use HasFactory<\Database\Factories\ProizvodFactory> */
    use HasFactory;
    protected $fillable=['naziv','cena'];
    public $timestamps=false;
    protected $table = 'proizvods';
}
