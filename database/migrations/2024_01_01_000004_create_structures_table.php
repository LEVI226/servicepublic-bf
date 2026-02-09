<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('structures', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('sigle')->nullable();
            $table->string('slug')->unique();
            $table->enum('type', ['ministere', 'institution', 'direction', 'secretariat', 'autre'])->default('autre');
            $table->text('description')->nullable();
            $table->string('adresse')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('site_web')->nullable();
            $table->string('horaires')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('structures')->onDelete('cascade');
            $table->string('ministre')->nullable();
            $table->string('photo_ministre')->nullable();
            $table->integer('ordre')->default(0);
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('structures');
    }
};
