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
        Schema::table('scenas', function (Blueprint $table) {
            $table
                ->foreign('film_id')
                ->references('FilmId')
                ->on('films')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scenas', function (Blueprint $table) {
            $table->dropForeign(['film_id']);
        });
    }
};
