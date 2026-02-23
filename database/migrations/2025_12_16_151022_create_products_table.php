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
        Schema::create('products', function (Blueprint $table) {
            // p_id (primary key)
            $table->id('p_id'); // Laravel's default id() creates an auto-incrementing primary key named 'id' by default. Using 'p_id' specifically requires this syntax.

            // p_name, p_desc, p_price, p_offerprice, p_stock, p_status
            $table->string('p_name');
            $table->text('p_desc')->nullable(); // Description can be longer, and potentially optional.
            $table->decimal('p_price', 12, 2); // Price storage (10 digits total, 2 decimal places).
            $table->decimal('p_offerprice', 12, 2)->nullable(); // Offer price (optional).

            // p_imgs (multiple uploads - store paths as JSON)
            // Note: Handling the 5 photo limit is done at the application/validation level, not the database schema level.
            $table->json('p_imgs')->nullable();

            $table->integer('p_stock')->default(1);
            $table->boolean('p_status')->default(true); // Status (e.g., active/inactive).
            $table->foreignId('cat_id')->constrained('categories', 'cat_id')->onDelete('cascade');

            // p_addedat, p_updatedat
            // Laravel's timestamps() handles created_at and updated_at automatically.
            $table->timestamps();
            // If you specifically need the column names you listed:
            // $table->timestamp('p_addedat')->useCurrent();
            // $table->timestamp('p_updatedat')->useCurrent()->useCurrentOnUpdate();


            // cat_id (foreign key)
            // Assuming you have a 'categories' table with an 'id' column.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('products');
    }
};
