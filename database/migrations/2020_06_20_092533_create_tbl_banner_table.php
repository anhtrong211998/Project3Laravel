<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_banner', function (Blueprint $table) {
            $table->Increments('banner_id');
            $table->string('banner_desc')->nullable();
            $table->text('banner_image')->nullable();
            $table->integer('category_banner_id')->nullable();
            $table->integer('banner_status')->nullable();
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
        Schema::dropIfExists('tbl_banner');
    }
}
