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
        Schema::create('scenas', function (Blueprint $table) {
            $table->bigIncrements('ScenaId');
            $table->unsignedBigInteger('film_id');
            $table->string('Lokacija');
            $table->date('DatumSnimanja')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scenas');
    }
};
