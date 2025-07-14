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
        Schema::create('zaposlenis', function (Blueprint $table) {
            $table->bigIncrements('ZaposleniId');
            $table->string('Ime', 20);
            $table->string('Prezime', 20);
            $table->string('Uloga');
            $table->enum('Status', ['aktivan', 'neaktivan', 'odsutan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zaposlenis');
    }
};
