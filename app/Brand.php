<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //
    // protected $table='tbl_brand';
    // protected $primaryKey='brand_id';
    protected $table = 'tbl_brand';
    protected $primaryKey = 'brand_id';
    protected $fillable=[
    	'brand_name',
    	'brand_logo',
    	'brand_status',
    ];
    public function Product(){
    	return $this->hasMany('App\Product','brand_product_id','brand_id');
    }
}
