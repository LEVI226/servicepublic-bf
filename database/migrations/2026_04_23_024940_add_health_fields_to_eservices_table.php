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
        Schema::table('eservices', function (Blueprint $table) {
            $table->integer('fail_count')->default(0)->after('url');
            $table->boolean('is_online')->default(true)->after('fail_count');
        });
    }

    public function down(): void
    {
        Schema::table('eservices', function (Blueprint $table) {
            $table->dropColumn(['fail_count', 'is_online']);
        });
    }
};
