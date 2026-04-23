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
            $table->foreignId('procedure_id')->nullable()->constrained()->onDelete('set null');
            $table->string('title', 500);
            $table->string('file_path', 500);
            $table->unsignedInteger('file_size')->nullable();
            $table->string('file_type', 50)->nullable();
            $table->unsignedInteger('downloads_count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
