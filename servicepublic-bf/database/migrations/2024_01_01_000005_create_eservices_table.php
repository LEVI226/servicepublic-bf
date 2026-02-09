<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eservices', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->longText('contenu');
            $table->foreignId('categorie_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('structure_id')->nullable()->constrained('structures')->onDelete('set null');
            $table->string('icone')->nullable();
            $table->string('url_externe')->nullable();
            $table->boolean('en_ligne')->default(true);
            $table->integer('duree_traitement')->nullable();
            $table->decimal('cout', 10, 2)->nullable();
            $table->json('champs_formulaire')->nullable();
            $table->json('documents_requis')->nullable();
            $table->integer('vues')->default(0);
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eservices');
    }
};
