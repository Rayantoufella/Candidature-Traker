<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidatures', function (Blueprint $table) {
            $table->id();
            $table->string('entreprise');
            $table->string('post');
            $table->string('URL');
            $table->enum('status', ['to_review', 'interview_scheduled', 'offer_received', 'rejected', 'abandoned'])->default('to_review');
            $table->Enum('priorite' ,['low', 'medium', 'high'])->default('medium');
            $table->text('description')->nullable();
            $table->date('applied_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidatures');
    }
};
