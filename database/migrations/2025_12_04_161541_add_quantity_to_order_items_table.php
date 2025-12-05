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
        Schema::table('order_items', function (Blueprint $table) {
            // إضافة عمود quantity إذا لم يكن موجودًا
            if (!Schema::hasColumn('order_items', 'quantity')) {
                $table->integer('quantity')->default(1)->after('price');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            // حذف العمود في حالة التراجع
            if (Schema::hasColumn('order_items', 'quantity')) {
                $table->dropColumn('quantity');
            }
        });
    }
};