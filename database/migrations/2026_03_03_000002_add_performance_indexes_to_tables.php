<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Only add indexes that don't already exist
        Schema::table('procedures', function (Blueprint $table) {
            $table->index(['is_active', 'views_count'], 'idx_procedures_active_views');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->index(['is_published', 'published_at'], 'idx_articles_published');
        });

        Schema::table('organismes', function (Blueprint $table) {
            $table->index(['is_active', 'name'], 'idx_organismes_active_name');
        });
    }

    public function down(): void
    {
        Schema::table('procedures', function (Blueprint $table) {
            $table->dropIndex('idx_procedures_active_views');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->dropIndex('idx_articles_published');
        });

        Schema::table('organismes', function (Blueprint $table) {
            $table->dropIndex('idx_organismes_active_name');
        });
    }
};
