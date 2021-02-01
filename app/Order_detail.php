<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    //
    protected $fillable = [
    	'order_detail_order_id', 'order_detail_product_id','order_detail_product_name','order_detail_product_quanty','order_detail_product_price','order_detail_image','order_detail_total_price'
    ];
    protected $primaryKey = 'order_detail_id';
 	protected $table = 'tbl_order_detail';

 	public function Order(){
 		return $this->belongsTo('App\Order', 'order_detail_order_id','order_id');
 	}
 	public function Product(){
 		return $this->belongsTo('App\Product', 'order_detail_product_id','product_id');
 	}
}
