<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('life_event_procedure', function (Blueprint $table) {
            $table->foreignId('life_event_id')->constrained()->onDelete('cascade');
            $table->foreignId('procedure_id')->constrained()->onDelete('cascade');
            $table->integer('order')->default(0);
            $table->primary(['life_event_id', 'procedure_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('life_event_procedure');
    }
};
