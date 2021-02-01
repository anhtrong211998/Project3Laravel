<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //
    protected $table =  'tbl_ratings';
    //khai bao khoa chinh
    protected $primaryKey = 'rating_id';
    protected $fillable = [
        'rating_product_id', 'rating_user_id', 'rating_content','rating_number','rating_active'
    ];
    public function Product(){
    	return $this->belongsTo('App\Product','rating_product_id','product_id');
    }
    public function User(){
    	return $this->belongsTo('App\User','rating_user_id','id');
    }
}
