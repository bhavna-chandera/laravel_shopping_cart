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
        //
        Schema::create('order_items', function (Blueprint $table) {
            // add_id as primary key auto-increment
            $table->id('order_item_id');

            // user_id as foreign key
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('order_id')->constrained('orders', 'order_id')->onDelete('cascade');
            $table->foreignId('p_id')->constrained('products', 'p_id')->onDelete('cascade');

            $table->integer('price');
            $table->integer('qty');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('order_items');
    }
};
