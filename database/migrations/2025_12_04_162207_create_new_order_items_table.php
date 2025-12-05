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
        Schema::create('new_order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('game_id');
            $table->decimal('price', 8, 2);
            $table->integer('quantity')->default(1);
            $table->integer('duration');
            $table->decimal('rental_price', 8, 2);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('game_id')->references('id')->on('games');
        });

        // نقل البيانات من الجدول القديم إلى الجديد
        DB::statement('INSERT INTO new_order_items (order_id, game_id, price, quantity, rental_price, created_at, updated_at)
                      SELECT order_id, game_id, price, quantity, rental_price, created_at, updated_at FROM order_items');

        // إعادة تسمية الجداول
        Schema::rename('order_items', 'old_order_items');
        Schema::rename('new_order_items', 'order_items');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('order_items', 'new_order_items');
        Schema::rename('old_order_items', 'order_items');
        Schema::dropIfExists('new_order_items');
    }
};