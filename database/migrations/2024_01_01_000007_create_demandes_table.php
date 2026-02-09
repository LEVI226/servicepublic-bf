<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('eservice_id')->constrained('eservices')->onDelete('cascade');
            $table->json('donnees_formulaire')->nullable();
            $table->json('documents_joints')->nullable();
            $table->enum('statut', ['brouillon', 'soumise', 'en_cours', 'en_attente', 'traitee', 'rejetee', 'annulee'])->default('brouillon');
            $table->text('commentaire')->nullable();
            $table->foreignId('traite_par')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('date_soumission')->nullable();
            $table->timestamp('date_traitement')->nullable();
            $table->date('date_rendez_vous')->nullable();
            $table->string('lieu_rendez_vous')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};
