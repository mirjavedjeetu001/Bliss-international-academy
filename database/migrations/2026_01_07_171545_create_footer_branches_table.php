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
        Schema::create('footer_branches', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Campus/Branch name
            $table->string('emis_no')->nullable(); // EMIS Number
            $table->string('school_code')->nullable(); // School Code
            $table->text('address'); // Address
            $table->string('phone')->nullable(); // Phone number
            $table->string('email')->nullable(); // Email
            $table->integer('order')->default(0); // Display order
            $table->boolean('is_active')->default(true); // Active status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footer_branches');
    }
};
