<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->enum('type', ['loi', 'decret', 'arrete', 'circulaire', 'note', 'autre'])->default('autre');
            $table->foreignId('categorie_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->foreignId('structure_id')->nullable()->constrained('structures')->onDelete('set null');
            $table->string('numero')->nullable();
            $table->date('date_signature')->nullable();
            $table->date('date_publication')->nullable();
            $table->string('fichier');
            $table->string('format')->nullable();
            $table->integer('taille')->nullable();
            $table->integer('telechargements')->default(0);
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
