<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('scena_zaposleni', function (Blueprint $table) {
            $table->unsignedBigInteger('scena_id');
            $table->unsignedBigInteger('zaposleni_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scena_zaposleni');
    }
};
