<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'tbl_category';
    protected $primaryKey = 'category_id';
    protected $fillable=[
    	'category_name',
    	'category_desc',
    	'category_status',
    ];
    public function Catetory(){
    	return $this->hasMany('App\Catetory','category_catetory_id','category_id');
    }
    public function Product(){
    	return $this->hasManyThrough('App\Product','App\Catetory','category_catetory_id','catetory_product_id','category_id');
    }
}
