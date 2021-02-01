<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    //
    protected $table = 'tbl_provider';
    protected $primaryKey = 'provider_id';
    protected $fillable=[
    	'provider_name',
    	'provider_address',
    	'provider_email',
    	'provider_phone',
    	'provider_status',

    ];
    public function Product(){
    	return $this->hasMany('App\Product','provider_product_id','provider_id');
    }
}
