<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $timestamps = false;
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('analyses', function (Blueprint $table) {
            $table->id('analy_id');
            $table->foreignId('p_id')->constrained('products', 'p_id')->onDelete('cascade');
            $table->foreignId('cat_id')->constrained('categories', 'cat_id')->onDelete('cascade');
            $table->integer('counter_value');
            $table->dateTime('visited_at');
            $table->dateTime('updated_at')->nullable();
            // $table->timestamps();
            $table->unique('p_id');   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analyses');
    }
};
