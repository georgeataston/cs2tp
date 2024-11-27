<?php

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
       Schema::create('orders', function (Blueprint $table) {
            $table->id(); // primary key
            $table->unsignedBigInteger('user_id')->nullable(); // nullable allows guests to checkout without needing to create an account which makkes user_id null
            $table->decimal('total_price', 8, 2);
            $table->timestamps();
            /**
             * places basic orders where a customer (user_id) links back to a customer in accounts database
             * the total price is shown to pay the initial price for the order.
             */

             $table->foreign('user_id')->references('aid')->on('accounts')->onDelete('cascade'); // foriegn key linking back to accounts table
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
