<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('kupovinas', function (Blueprint $table) {
            $table->date('datum_kupovine');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kupovinas', function (Blueprint $table) {
            $table->dropColumn('datum_kupovine');
        });
    }
};
