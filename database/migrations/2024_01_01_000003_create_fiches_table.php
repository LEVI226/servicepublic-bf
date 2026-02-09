<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fiches', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->longText('contenu');
            $table->foreignId('categorie_id')->constrained('categories')->onDelete('cascade');
            $table->string('icone')->nullable();
            $table->integer('duree_traitement')->nullable()->comment('En jours');
            $table->decimal('cout', 10, 2)->nullable();
            $table->json('documents_requis')->nullable();
            $table->json('etapes')->nullable();
            $table->string('contact')->nullable();
            $table->string('lieu')->nullable();
            $table->integer('vues')->default(0);
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fiches');
    }
};
