<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCouponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_coupon', function (Blueprint $table) {
            $table->Increments('coupon_id');
            $table->string('coupon_name');
            $table->integer('coupon_time');
            $table->integer('coupon_condition');
            $table->integer('coupon_number');
            $table->string('coupon_code')->unique();
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
        Schema::dropIfExists('tbl_coupon');
    }
}
