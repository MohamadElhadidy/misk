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
        Schema::table('products', function (Blueprint $table) {
            $table->integer('stock')->default(0)->after('featured'); // Product quantity
            $table->boolean('track_stock')->default(true)->after('stock'); // Enable/disable stock tracking
            $table->boolean('show_out_of_stock')->default(true)->after('track_stock'); // Show or hide out-of-stock products
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('stock');
            $table->dropColumn('track_stock');
            $table->dropColumn('show_out_of_stock');
        });
    }
};
