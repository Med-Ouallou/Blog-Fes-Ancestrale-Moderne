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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content'); // Long text for rich HTML content
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // References users, cascade delete if user removed
            $table->timestamps();
            $table->index('title'); // Index for search on title
            $table->index('status'); // Index for filtering by status
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};