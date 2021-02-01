<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblFeeshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feeship', function (Blueprint $table) {
            $table->Increments('fee_id');
            $table->integer('fee_matp');
            $table->integer('fee_maquanhuyen');
            $table->integer('fee_maxaphuong');
            $table->integer('fee_ship');
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
        Schema::dropIfExists('feeship');
    }
}
