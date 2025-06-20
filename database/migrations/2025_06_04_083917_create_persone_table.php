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
        Schema::create('persone', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('nome');
            $table->string('colore');
            $table->string('email')->nullable();
            $table->string('invio')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persone');
    }
};
