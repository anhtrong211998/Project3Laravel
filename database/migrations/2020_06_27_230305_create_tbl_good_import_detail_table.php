<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblGoodImportDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_GoodImport_detail', function (Blueprint $table) {
            $table->Increments('GoodImport_detail_id');
            $table->string('GoodImport_detail_GoodImport_id')->nullable();
            $table->integer('GoodImport_detail_product_id')->nullable();
            $table->integer('GoodImport_detail_product_quanty')->nullable();
            $table->integer('GoodImport_detail_product_price')->nullable();
            $table->integer('GoodImport_detail_total_price')->nullable();
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
        Schema::dropIfExists('tbl_GoodImport_detail');
    }
}
