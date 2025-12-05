<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceFieldsToGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->decimal('price_per_day', 8, 2)->default(10.00)->after('category_id');
            $table->decimal('price_per_week', 8, 2)->default(50.00)->after('price_per_day');
            $table->decimal('price_per_month', 8, 2)->default(180.00)->after('price_per_week');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->dropColumn(['price_per_day', 'price_per_week', 'price_per_month']);
        });
    }
}