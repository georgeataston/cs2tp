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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('rid')->primary();
            $table->bigInteger('user_uid')->unsigned();
            $table->bigInteger('stock_sid')->unsigned();
            $table->integer('rating');
            $table->string('title');
            $table->string('content');
            $table->timestamps();

            $table->foreign('uid')->references('uid')->on('users');
            //$table->foreign('sid')->references('sid')->on('stock');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
