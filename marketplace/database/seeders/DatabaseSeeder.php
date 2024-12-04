<?php

namespace Database\Seeders;
use App\Models\Korisnik;
use App\Models\Proizvod;
use App\Models\Aukcija;
use App\Models\Kupovina;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       
        $this->call([
            AukcijaSeeder::class,
            KorisnikSeeder::class,
            KupovinaSeeder::class,
            ProizvodSeeder::class,
        ]);

    }
}
