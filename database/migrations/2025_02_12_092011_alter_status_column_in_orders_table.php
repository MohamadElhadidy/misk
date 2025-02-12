<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterStatusColumnInOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // First, change the column type to string temporarily
            $table->string('status')->change();
        });

        Schema::table('orders', function (Blueprint $table) {
            // Then, re-add the ENUM with new values
            $table->enum('status', [
                'pending', 'processing', 'shipped', 'delivered', 'canceled', 'refunded', 'returned'
            ])->default('pending')->change();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('status', [
                'pending', 'processing', 'shipped', 'delivered', 'canceled', 'refunded'
            ])->default('pending')->change();
        });
    }
}

