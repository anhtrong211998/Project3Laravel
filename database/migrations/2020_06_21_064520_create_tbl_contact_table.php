<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_contact', function (Blueprint $table) {
            $table->Increments('contact_id');
            $table->string('contact_name')->nullable();
            $table->string('contact_title')->nullable();
            $table->longText('contact_content')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_company')->nullable();
            $table->string('contact_phone')->nullable();
            $table->longText('contact_address')->nullable();
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
        Schema::dropIfExists('tbl_contact');
    }
}
