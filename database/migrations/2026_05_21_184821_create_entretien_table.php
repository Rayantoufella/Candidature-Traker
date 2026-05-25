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
        Schema::create('entretien', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('note')->nullable();
            $table->text('description')->nullable();
            $table->string('type');
            $table->string('resultat')->nullable();
            $table->dateTime('date_entretien')->nullable();
            $table->foreignId('candidature_id')->constrained('candidatures')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entretien');
    }
};
