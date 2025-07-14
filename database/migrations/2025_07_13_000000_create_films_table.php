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
        Schema::create('films', function (Blueprint $table) {
            $table->bigIncrements('FilmId');
            $table->unsignedBigInteger('zanr_id');
            $table->string('Naziv', 100);
            $table->string('Status', 100);
            $table
                ->enum('Budzet', [
                    'predprodukcija',
                    'produkcija',
                    'postprodukcija',
                    'pauza',
                    'planiranje',
                    'distribucija',
                    'arhiviran',
                ])
                ->nullable();
            $table->date('DatumIzlaska')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
