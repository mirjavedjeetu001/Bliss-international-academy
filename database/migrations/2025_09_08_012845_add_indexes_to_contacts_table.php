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
        Schema::table('contacts', function (Blueprint $table) {
            // Add indexes for better performance
            $table->index('is_read');
            $table->index('created_at');
            $table->index('campus');
            $table->index(['is_read', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            // Drop indexes
            $table->dropIndex(['is_read']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['campus']);
            $table->dropIndex(['is_read', 'created_at']);
        });
    }
};
