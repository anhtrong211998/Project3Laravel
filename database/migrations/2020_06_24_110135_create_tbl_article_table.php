<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_article', function (Blueprint $table) {
            $table->Increments('article_id');
            $table->string('article_name')->nullable()->unique();
            $table->string('article_slug')->index();
            $table->string('article_description')->nullable();
            $table->longText('article_content')->nullable();
            $table->longText('article_avatar')->nullable();
            $table->tinyInteger('article_active')->index()->default(1);
            $table->integer('article_author_id')->index()->default(0);
            $table->string('article_description_seo')->nullable();
            $table->string('article_title_seo')->nullable();
            $table->string('article_view')->default(0);
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
        Schema::dropIfExists('tbl_article');
    }
}
