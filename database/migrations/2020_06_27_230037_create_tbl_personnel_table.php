<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPersonnelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_personnel', function (Blueprint $table) {
            $table->Increments('personnel_id');
            $table->string('personnel_name')->nullable();
            $table->char('personnel_phone')->nullable();
            $table->string('personnel_email')->unique();
            $table->string('personnel_sex')->nullable();
            $table->text('personnel_address')->nullable();
            $table->integer('personnel_position')->nullable();
            $table->string('personnel_birth')->nullable();
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
        Schema::dropIfExists('tbl_personnel');
    }
}
