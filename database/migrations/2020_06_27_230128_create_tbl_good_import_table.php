<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblGoodImportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_GoodImport', function (Blueprint $table) {
            $table->string('GoodImport_id');
            $table->integer('GoodImport_personnel_id');
            $table->integer('GoodImport_provider_id');
            $table->integer('GoodImport_total_price');
            $table->timestamps();
            $table->primary('GoodImport_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_GoodImport');
    }
}
