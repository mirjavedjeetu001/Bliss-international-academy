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
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('footer_important_links_title')->nullable()->after('footer_registration_number');
            $table->string('footer_useful_links_title')->nullable()->after('footer_important_links_title');
            $table->string('footer_satkhira_campus_title')->nullable()->after('footer_useful_links_title');
            $table->string('footer_debhata_campus_title')->nullable()->after('footer_satkhira_campus_title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['footer_important_links_title', 'footer_useful_links_title', 'footer_satkhira_campus_title', 'footer_debhata_campus_title']);
        });
    }
};
