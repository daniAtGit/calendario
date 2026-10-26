<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('icone', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nome');
            $table->string('classe');
            $table->timestamps();
        });

        Schema::table('eventi', function (Blueprint $table) {
            $table->foreignUuid('icona_id')->nullable()->constrained('icone')->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('eventi', function (Blueprint $table) {
            $table->dropForeign(['icona_id']);
            $table->dropColumn('icona_id');
        });
        Schema::dropIfExists('icone');
    }
};
