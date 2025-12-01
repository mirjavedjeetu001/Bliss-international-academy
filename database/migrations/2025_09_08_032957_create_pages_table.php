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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('detail'); // HTML content
            $table->json('images')->nullable(); // Multiple images
            $table->json('pdfs')->nullable(); // Multiple PDFs
            $table->string('status')->default('active'); // active, inactive
            $table->string('slug')->unique(); // URL-friendly slug
            $table->timestamps();
            
            // Indexes for performance
            $table->index('status');
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
