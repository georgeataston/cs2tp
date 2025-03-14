<?php

use App\Models\Order;
use App\Models\OrderItem;
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
        $orderItems = OrderItem::all();
        foreach ($orderItems as $oi)
            $oi->delete();

        $orders = Order::all();
        foreach ($orders as $o)
            $o->delete();

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign('order_items_product_id_foreign');
            $table->dropColumn('product_id');

            $table->dropColumn('size');

            $table->unsignedBigInteger('size_id')->after('order_id');
            $table->foreign('size_id')->references('id')->on('sizes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign('order_items_size_id_foreign');
            $table->dropColumn('size_id');

            $table->string('size');

            $table->unsignedBigInteger('product_id')->after('order_id');
            $table->foreign('product_id')->references('id')->on('stocks');
        });
    }
};
