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
        Schema::table('video_galleries', function (Blueprint $table) {
            $table->unsignedBigInteger('media_category_id')->nullable()->after('type');
            $table->foreign('media_category_id')->references('id')->on('media_categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('video_galleries', function (Blueprint $table) {
            $table->dropForeign(['media_category_id']);
            $table->dropColumn('media_category_id');
        });
    }
};
