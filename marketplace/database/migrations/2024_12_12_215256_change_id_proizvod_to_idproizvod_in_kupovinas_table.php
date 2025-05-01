<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
            // Step 1: Add the new column
            Schema::table('kupovinas', function (Blueprint $table) {
                $table->integer('id_proizvod')->nullable();
            });
    
            // Step 2: Copy data from the old column to the new column
            DB::statement('UPDATE kupovinas SET id_proizvod = idProizvod');
    
            // Step 3: Drop the old column
            Schema::table('kupovinas', function (Blueprint $table) {
                $table->dropColumn('idProizvod');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
           // Step 1: Add the old column back
           Schema::table('kupovinas', function (Blueprint $table) {
            $table->integer('idProizvod')->nullable();
        });

        // Step 2: Copy data back to the old column
        DB::statement('UPDATE kupovinas SET idProizvod = id_proizvod');

        // Step 3: Drop the new column
        Schema::table('kupovinas', function (Blueprint $table) {
            $table->dropColumn('id_proizvod');
        });
    }
    
};
