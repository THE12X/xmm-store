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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('brand'); // e.g., Samsung, Apple, Xiaomi
            $table->decimal('price', 8, 2);
            $table->enum('category', ['Casual', 'Gaming', 'Heavy Usage']);
            $table->text('description')->nullable();
            $table->string('image'); // Stores relative path to image file
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
