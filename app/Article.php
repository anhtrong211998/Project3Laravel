<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $fillable = [
    	'article_name', 'article_slug', 'article_description','article_content','article_avatar','article_active','article_author_id','article_description_seo','article_title_seo','article_view'
    ];
    protected $primaryKey = 'article_id';
 	protected $table = 'tbl_article';
}
