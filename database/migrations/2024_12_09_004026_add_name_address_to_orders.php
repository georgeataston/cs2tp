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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('fullName')->after('status')->nullable();
            $table->string('email')->after('fullName')->nullable();
            $table->string('addressLineOne')->after('email');
            $table->string('addressLineTwo')->after('addressLineOne')->nullable();
            $table->string('city')->after('addressLineTwo');
            $table->string('postCode')->after('city');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('fullName');
            $table->dropColumn('email');
            $table->dropColumn('addressLineOne');
            $table->dropColumn('addressLineTwo');
            $table->dropColumn('city');
            $table->dropColumn('postCode');
        });
    }
};
