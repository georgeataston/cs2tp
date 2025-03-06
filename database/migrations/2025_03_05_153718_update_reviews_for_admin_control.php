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
        Schema::table('reviews', function (Blueprint $table) {
            $table->boolean('deleted')->default(false)->after('content');
            $table->unsignedBigInteger('deleted_by')->nullable()->default(null)->after('deleted');
            $table->text('deleted_reason')->nullable()->default(null)->after('deleted_by');

            $table->boolean('edited')->default(false)->after('deleted_reason');
            $table->unsignedBigInteger('edited_by')->nullable()->default(null)->after('edited');
            $table->text('edited_reason')->nullable()->default(null)->after('edited_by');

            $table->foreign('deleted_by')->references('aid')->on('accounts');
            $table->foreign('edited_by')->references('aid')->on('accounts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn('deleted');
            $table->dropForeign('reviews_deleted_by_foreign');
            $table->dropColumn('deleted_by');
            $table->dropColumn('deleted_reason');
            $table->dropColumn('edited');
            $table->dropForeign('reviews_edited_by_foreign');
            $table->dropColumn('edited_by');
            $table->dropColumn('edited_reason');
        });
    }
};
