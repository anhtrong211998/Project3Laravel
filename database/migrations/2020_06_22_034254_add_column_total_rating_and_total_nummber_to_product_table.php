<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTotalRatingAndTotalNummberToProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_product', function (Blueprint $table) {
            //
            $table->integer('product_total_rating')->default(0)->comment('tổng số đánh giá');
            $table->integer('rating_product_total')->default(0)->comment('tổng số lượt đánh giá');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_product', function (Blueprint $table) {
            //
        });
    }
}
