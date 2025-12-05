<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('orders')->insert([
            [
                'user_id' => 1,
                'total_price' => 45.00,
                'state' => \App\Enums\OrderState::PAID->value,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'total_price' => 30.00,
                'state' => \App\Enums\OrderState::COMPLETED->value,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
        DB::table('order_items')->insert([

            // Order 1
            [
                'order_id' => 1,
                'game_id' => 3, // Outlast
                'price' => 15.00,
                'duration' => '3_days',
                'rental_price' => 15.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 1,
                'game_id' => 5, // GTA V
                'price' => 30.00,
                'duration' => 'week',
                'rental_price' => 30.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Order 2
            [
                'order_id' => 2,
                'game_id' => 1, // Silent Hill 4
                'price' => 30.00,
                'duration' => 'week',
                'rental_price' => 30.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
