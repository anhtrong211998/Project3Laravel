<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblProviderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_provider', function (Blueprint $table) {
            $table->Increments('provider_id');
            $table->string('provider_name')->nullable();
            $table->text('provider_address')->nullable();
            $table->string('provider_phone',15)->nullable();
            $table->string('provider_email')->nullable();
            $table->integer('provider_status')->nullable();
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
        Schema::dropIfExists('tbl_provider');
    }
}
