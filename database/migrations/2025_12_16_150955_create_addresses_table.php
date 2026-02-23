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
        Schema::create('addresses', function (Blueprint $table) {
            // add_id as primary key auto-increment
            $table->id('add_id');

            // user_id as foreign key
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->string('name');
            $table->string('mobile');

            // pincode as 6-digit integer
            $table->integer('pincode');

            $table->text('address');
            $table->string('city');
            $table->string('landmark')->nullable();
            $table->string('mobile_alternate')->nullable();
            $table->string('state');

            // Enum for address type
            $table->enum('add_type', ['home', 'office']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('addresses');
    }
};
