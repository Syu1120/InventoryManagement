<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftdeletesToMultipleTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('goods', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('goods_scheduled_arrival', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('goods_stock', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('stores', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('goods', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('goods_scheduled_arrival', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('goods_stock', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('stores', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
