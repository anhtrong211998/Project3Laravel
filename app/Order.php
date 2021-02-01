<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
    	'order_customer_id', 'order_address','order_payment_method','order_coupon_sale','order_fee_ship','order_total_price','order_status'
    ];
    protected $primaryKey = 'order_id';
 	protected $table = 'tbl_orders';
 	public $incrementing = false;
 	public function Order_detail(){
 		return $this->hasMany('App\Order_detail', 'order_detail_order_id','order_id');
 	}
 	public function Customer(){
 		return $this->belongsTo('App\Customer', 'order_customer_id','customer_id');
 	}
 	public function User(){
 		return $this->belongsTo('App\User', 'order_customer_id','id');
 	}
}
