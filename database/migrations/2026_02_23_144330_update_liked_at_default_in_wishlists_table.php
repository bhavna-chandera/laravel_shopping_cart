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
        Schema::table('wishlists', function (Blueprint $table) {
            // Change liked_at to have default CURRENT_TIMESTAMP
            $table->timestamp('liked_at')->useCurrent()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wishlists', function (Blueprint $table) {
           // Revert back to plain datetime with no default
            $table->dateTime('liked_at')->change();
        });
    }
};
