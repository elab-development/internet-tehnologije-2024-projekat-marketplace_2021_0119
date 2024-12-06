<?php

namespace Database\Factories;
use App\Models\Proizvod;
use App\Models\Korisnik;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kupovina>
 */
class KupovinaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_proizvod'=>Proizvod::factory(),
            'idKorisnik'=>Korisnik::factory(),
            'datum_kupovine'=>$this->faker->date()
        ];
    }
}
