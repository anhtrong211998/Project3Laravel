<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCatetoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_catetory', function (Blueprint $table) {
            $table->Increments('catetory_id');
            $table->string('catetory_name')->nullable();
            $table->text('catetory_desc')->nullable();
            $table->integer('catetory_status')->nullable();
            $table->integer('category_catetory_id')->nullable();
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
        Schema::dropIfExists('tbl_catetory');
    }
}
