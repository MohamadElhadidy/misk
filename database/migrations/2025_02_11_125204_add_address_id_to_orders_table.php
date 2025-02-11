<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressIdToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('address_id')->nullable()->after('user_id');  // Add 'address_id' column after the 'id' column
            $table->foreign('address_id')->references('id')->on('user_addresses')->onDelete('set null'); // Add foreign key constraint (optional)
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['address_id']); // Drop foreign key if exists
            $table->dropColumn('address_id');  // Drop the 'address_id' column
        });
    }
}
