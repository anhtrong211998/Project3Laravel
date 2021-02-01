<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_orders', function (Blueprint $table) {
            $table->string('order_id');
            $table->string('order_customer_id');
            $table->text('order_address');
            $table->string('order_payment_method');
            $table->integer('order_coupon_sale');
            $table->integer('order_fee_ship');
            $table->integer('order_total_price');
            $table->integer('order_status');
            $table->timestamps();
            $table->primary('order_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_orders');
    }
}
