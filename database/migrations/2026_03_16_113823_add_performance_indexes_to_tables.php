<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('procedures', function (Blueprint $table) {
            $table->index(['category_id', 'is_active']);
            $table->index(['is_featured', 'is_active']);
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->index(['is_published', 'published_at']);
        });

        Schema::table('organismes', function (Blueprint $table) {
            $table->index('is_active');
        });

        Schema::table('eservices', function (Blueprint $table) {
            $table->index(['is_active', 'order']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->index(['is_active', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex(['is_active', 'order']);
        });

        Schema::table('eservices', function (Blueprint $table) {
            $table->dropIndex(['is_active', 'order']);
        });

        Schema::table('organismes', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->dropIndex(['is_published', 'published_at']);
        });

        Schema::table('procedures', function (Blueprint $table) {
            $table->dropIndex(['category_id', 'is_active']);
            $table->dropIndex(['is_featured', 'is_active']);
        });
    }
};
