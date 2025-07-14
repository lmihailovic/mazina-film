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
        Schema::table('scena_zaposleni', function (Blueprint $table) {
            $table
                ->foreign('scena_id')
                ->references('ScenaId')
                ->on('scenas')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('zaposleni_id')
                ->references('ZaposleniId')
                ->on('zaposlenis')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scena_zaposleni', function (Blueprint $table) {
            $table->dropForeign(['scena_id']);
            $table->dropForeign(['zaposleni_id']);
        });
    }
};
