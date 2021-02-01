<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblUserFeeshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_user_feeship', function (Blueprint $table) {
            $table->Increments('f_u_id');
            $table->integer('f_u_user_id')->nullable();
            $table->integer('f_u_fee_id')->nullable();
            $table->string('f_u_address')->nullable();
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
        Schema::dropIfExists('tbl_user_feeship');
    }
}
