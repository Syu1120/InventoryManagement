<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsScheduledArrivalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_scheduled_arrival', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('store_id');
            $table->integer('goods_id');
            $table->date('date');
            $table->smallInteger('quantity');
            $table->float('weight');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods_scheduled_arrival');
    }
}
