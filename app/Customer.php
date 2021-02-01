<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = [
    	'customer_name', 'customer_phone','customer_address','customer_email'
    ];
    protected $primaryKey = 'customer_id';
 	protected $table = 'tbl_customers';
 	public $incrementing = false;
 	public function Order(){
 		return $this->hasMany('App\Order', 'order_customer_id','customer_id');
 	}
}
