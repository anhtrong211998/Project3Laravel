<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCustormerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_customers', function (Blueprint $table) {
            $table->string('customer_id');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->text('customer_address');
            $table->string('customer_email');
            $table->timestamps();
            $table->primary('customer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_customers');
    }
}
