<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
       Schema::create('order_items', function (Blueprint $table) {
            $table->id(); // primary key  changed to 'id'
            $table->unsignedBigInteger('order_id'); // foreign key linking to orders table
            $table->unsignedBigInteger('product_id'); // foreign key linking to ghe  stock table
            $table->integer('quantity'); // how many items per basket
            $table->decimal('price', 8, 2); // price of item
            $table->timestamps();

            // foreign keys
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('stocks')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
