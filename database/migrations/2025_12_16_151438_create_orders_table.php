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
        Schema::create('orders', function (Blueprint $table) {
            // add_id as primary key auto-increment
            $table->id('order_id');

            // user_id as foreign key
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->foreignId('add_id')->constrained('addresses', 'add_id')->onDelete('cascade');


            $table->enum('order_status', ['in_process', 'dispatched', 'out_for_delivery', 'delivered', 'cancelled'])->default('in_process');
            $table->double('grand_total', 15, 2);

            $table->dateTime('order_date');
            $table->dateTime('order_placed_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('orders');
    }
};
