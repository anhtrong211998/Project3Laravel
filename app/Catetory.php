<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catetory extends Model
{
    //
    protected $table='tbl_catetory';
    protected $primaryKey='catetory_id';
    protected $fillable=[
    	'catetory_name',
    	'catetory_desc',
    	'catetory_status',
    	'category_catetory_id'

    ];
    public function CategoryProduct(){
    	return $this->belongsTo('App\Categoryt','category_catetory_id','category_id');
    }
    public function Product(){
    	return $this->hasMany('App\Product','catetory_product_id','catetory_id');
    }
}
