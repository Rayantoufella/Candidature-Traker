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
            $table->Enum('type' ,['telephone', 'visio', 'presentielle' , 'technique' ,])->default('technique');
            $table->foreignId('candidature_id')->constrained('candidatures')->onDelete('cascade');
            $table->enum('resultat', ['en_cours' ,'positive','negative'])->default('en_cours');
            $table->timestamp('date_entretien');
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
