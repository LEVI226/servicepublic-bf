<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->string('slug', 500)->nullable()->after('title');
            $table->index('slug');
        });

        // Generate slugs for existing documents from their title
        \App\Models\Document::all()->each(function ($doc) {
            $doc->slug = \Illuminate\Support\Str::slug($doc->title);
            $doc->save();
        });
    }

    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropIndex(['slug']);
            $table->dropColumn('slug');
        });
    }
};
