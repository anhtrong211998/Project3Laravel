<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_order_detail', function (Blueprint $table) {
            $table->Increments('order_detail_id');
            $table->string('order_detail_order_id');
            $table->integer('order_detail_product_id');
            $table->string('order_detail_product_name');
            $table->integer('order_detail_product_quanty');
            $table->integer('order_detail_product_price');
            $table->integer('order_detail_total_price');
            $table->text('order_detail_image')->nullable();
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
        Schema::dropIfExists('tbl_order_detail');
    }
}
