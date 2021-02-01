<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_ratings', function (Blueprint $table) {
            $table->Increments('rating_id');
            $table->integer('rating_product_id')->index()->default(0);
            $table->integer('rating_user_id')->index()->default(0);
            $table->string('rating_content');       
            $table->tinyInteger('rating_number')->default(0);
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
        Schema::dropIfExists('tbl_ratings');
    }
}
