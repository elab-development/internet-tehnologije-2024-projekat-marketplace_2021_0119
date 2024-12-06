<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Korisnik>
 */
class KorisnikFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'ime'=>$this->faker->name(),
            'prezime'=>$this->faker->lastname(),
            'email'=>$this->faker->safeEmail(),
            'password'=> $this->faker->password()


        ];
    }
}