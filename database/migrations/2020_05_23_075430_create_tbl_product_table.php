<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_product', function (Blueprint $table) {
            $table->Increments('product_id');
            $table->string('product_name')->nullable();
            $table->integer('catetory_product_id')->nullable();
            $table->integer('brand_product_id')->nullable();
            $table->integer('provider_product_id')->nullable();
            $table->text('product_desc')->nullable();
            $table->text('product_content')->nullable();
            $table->decimal('product_quantity')->nullable();
            // $table->decimal('product_quantity_residual');
            $table->decimal('product_price')->nullable();
            $table->decimal('product_sale')->nullable();
            $table->text('product_image')->nullable();
            $table->integer('product_status')->nullable();
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
        Schema::dropIfExists('tbl_product');
    }
}
