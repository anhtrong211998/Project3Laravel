<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeeUser extends Model
{
    //
    protected $fillable = [
    	'f_u_user_id', 'f_u_fee_id','f_u_address'
    ];
    protected $primaryKey = 'f_u_id';
 	protected $table = 'tbl_user_feeship';

 	public function Feeship(){
 		return $this->belongsTo('App\Feeship', 'f_u_fee_id','fee_id');
 	}
 	public function User(){
 		return $this->belongsTo('App\User', 'f_u_user_id','id');
 	}
}
