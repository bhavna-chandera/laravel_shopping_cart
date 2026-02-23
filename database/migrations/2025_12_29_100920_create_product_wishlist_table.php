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
        // Schema::create('product_wishlist', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });

        Schema::create('product_wishlist', function (Blueprint $table) {
            $table->id(); // Optional, but often preferred
            $table->foreignId('p_id')->constrained('products', 'p_id')->onDelete('cascade');
            $table->foreignId('like_id')->constrained('wishlists', 'like_id')->onDelete('cascade');

            $table->timestamps();

            // Optional: Composite unique key to prevent duplicate entries
            $table->unique(['p_id', 'like_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_wishlist');
    }
};
