<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('oiid'); 
            $table->unsignedBigInteger('oid'); // foreign key to link back each item to a specific order(refers to id in order table)
            $table->unsignedBigInteger('product_id'); // foreign keyd to reference product infomration for each item in stock database
            $table->integer('quantity');
            $table->decimal('price', 8, 2);
            $table->timestamps();

            $table->foreign('oid')->references('oid')->on('orders')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
