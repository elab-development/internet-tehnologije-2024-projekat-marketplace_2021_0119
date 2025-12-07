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
            Schema::table('kupovinas', function (Blueprint $table) {
                $table->integer('id_proizvod')->nullable();
            });
    
            DB::statement('UPDATE kupovinas SET id_proizvod = idProizvod');

            Schema::table('kupovinas', function (Blueprint $table) {
                $table->dropColumn('idProizvod');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
           Schema::table('kupovinas', function (Blueprint $table) {
            $table->integer('idProizvod')->nullable();
        });

        DB::statement('UPDATE kupovinas SET idProizvod = id_proizvod');

        Schema::table('kupovinas', function (Blueprint $table) {
            $table->dropColumn('id_proizvod');
        });
    }
    
};
