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
        Schema::table('brands', function (Blueprint $table) {
            $table->boolean('deleted')->after('name')->default(false);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->boolean('deleted')->after('name')->default(false);
        });

        Schema::table('stocks', function (Blueprint $table) {
            $table->boolean('deleted')->after('price')->default(false);
        });

        Schema::table('sizes', function (Blueprint $table) {
            $table->dropColumn('visible');
            $table->boolean('deleted')->after('quantity')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->dropColumn('deleted');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('deleted');
        });

        Schema::table('stocks', function (Blueprint $table) {
            $table->dropColumn('deleted');
        });

        Schema::table('sizes', function (Blueprint $table) {
            $table->dropColumn('deleted');
            $table->boolean('visible')->after('quantity')->default(true);
        });
    }
};
