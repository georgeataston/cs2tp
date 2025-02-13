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
        Schema::table('password_reset', function (Blueprint $table) {
            $table->integer("allow_new_request")->after("expiry");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('password_reset', function (Blueprint $table) {
            $table->dropColumn("allow_new_request");
        });
    }
};
