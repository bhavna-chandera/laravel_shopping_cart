
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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id('rate_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('p_id')->constrained('products', 'p_id')->onDelete('cascade');
            $table->enum('rates', ['1', '2', '3', '4', '5']);
            $table->text('review');
            $table->foreignId('order_id')->constrained('orders', 'order_id')->onDelete('cascade');
            $table->timestamps();

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
