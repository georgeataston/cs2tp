<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_id');
            $table->string('image_path');
            $table->timestamps();

            $table->foreign('stock_id')
                  ->references('id')
                  ->on('stocks')
                  ->onDelete('cascade');
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};