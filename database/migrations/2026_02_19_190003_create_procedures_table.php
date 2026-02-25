<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('procedures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('subcategory_id')->nullable()->constrained()->onDelete('set null');
            $table->string('title', 500);
            $table->string('slug', 500)->unique();
            $table->text('description');
            $table->text('documents_required')->nullable();
            $table->text('cost')->nullable();
            $table->text('conditions')->nullable();
            $table->string('delay')->nullable();
            $table->text('more_info')->nullable();
            $table->string('source_file')->nullable();
            $table->boolean('is_free')->default(false);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('views_count')->default(0);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();

            $table->fullText(['title', 'description', 'documents_required', 'more_info'], 'procedures_fulltext');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('procedures');
    }
};
