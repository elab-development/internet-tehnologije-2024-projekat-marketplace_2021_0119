<?php

namespace Database\Seeders;
use App\Models\Kupovina;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KupovinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kupovina::factory()->count(10)->create();

        
    }
}
