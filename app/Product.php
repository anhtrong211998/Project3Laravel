<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //Khai bao bang ma model nay su dung
    protected $table =  'tbl_product';
    //khai bao khoa chinh
    protected $primaryKey = 'product_id';
    protected $fillable=[
        'product_name',
        'catetory_product_id',
        'brand_product_id',
        'provider_product_id',
        'product_desc',
        'product_content',
        'product_quantity',
        'product_price',
        'product_sale',
        'product_image',
        'product_status',

    ];
    public function Catetory(){
    	return $this->belongsTo('App\Catetory','catetory_product_id','catetory_id');
    }
    public function Brand(){
    	return $this->belongsTo('App\Brand','brand_product_id','brand_id');
    }
    public function Provider(){
        return $this->belongsTo('App\Provider','provider_product_id','provider_id');
    }
    public function Rating(){
        return $this->hasMany('App\Rating','rating_product_id','product_id');
    }
}
