<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('actualites', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->text('resume');
            $table->longText('contenu');
            $table->string('image')->nullable();
            $table->foreignId('structure_id')->nullable()->constrained('structures')->onDelete('set null');
            $table->enum('type', ['actualite', 'communique', 'avis'])->default('actualite');
            $table->boolean('a_la_une')->default(false);
            $table->timestamp('date_publication')->nullable();
            $table->integer('vues')->default(0);
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('actualites');
    }
};
