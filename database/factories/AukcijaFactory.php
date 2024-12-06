<?php

namespace Database\Factories;
use App\Models\Korisnik;
use App\Models\Proizvod;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aukcija>
 */
class AukcijaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'idProizvod'=>Proizvod::factory(),
            'idKorisnik'=>Korisnik::factory(),
        ];
    }
}
