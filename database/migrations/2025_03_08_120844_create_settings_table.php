<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up() {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key_name')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Insert default settings
        DB::table('settings')->insert([
            ['key_name' => 'store_name', 'value' => 'Name'],
            ['key_name' => 'store_title', 'value' => 'Title'],
            ['key_name' => 'store_logo', 'value' => ''],
            ['key_name' => 'favicon', 'value' => '/uploads/favicon.ico'],
            ['key_name' => 'banner_1', 'value' => '/uploads/banner1.jpg'],
            ['key_name' => 'banner_2', 'value' => '/uploads/banner2.jpg'],
            ['key_name' => 'banner_3', 'value' => '/uploads/banner3.jpg'],
            ['key_name' => 'store_email', 'value' => 'contact@store.com'],
            ['key_name' => 'store_phone', 'value' => '+123456789'],
            ['key_name' => 'store_address', 'value' => '123 Main St, City, Country'],
            ['key_name' => 'default_currency', 'value' => 'USD'],
            ['key_name' => 'default_language', 'value' => 'en'],
            ['key_name' => 'default_payment_currency', 'value' => 'USD'],
            ['key_name' => 'shipping_fee', 'value' => '10'],
            ['key_name' => 'social_facebook', 'value' => 'https://facebook.com/yourstore'],
            ['key_name' => 'social_instagram', 'value' => 'https://instagram.com/yourstore'],
            ['key_name' => 'social_twitter', 'value' => 'https://twitter.com/yourstore'],
            ['key_name' => 'social_linkedin', 'value' => 'https://linkedin.com/company/yourstore'],
            ['key_name' => 'social_tiktok', 'value' => ''],
            ['key_name' => 'social_snapchat', 'value' => ''],
            ['key_name' => 'meta_description', 'value' => 'Best products at the best prices.'],
            ['key_name' => 'maintenance_mode', 'value' => '0'],
        ]);
    }

    public function down() {
        Schema::dropIfExists('settings');
    }
};
