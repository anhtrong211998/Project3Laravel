<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feeship extends Model
{
    //
    // public $timestamps = false; //set time to false
    protected $fillable = [
    	'fee_matp', 'fee_maquanhuyen','fee_maxaphuong','fee_ship'
    ];
    protected $primaryKey = 'fee_id';
 	protected $table = 'feeship';

 	public function city(){
 		return $this->belongsTo('App\City', 'fee_matp','matp');
 	}
 	public function province(){
 		return $this->belongsTo('App\Province', 'fee_maquanhuyen','maqh');
 	}
 	public function ward(){
 		return $this->belongsTo('App\Wards', 'fee_maxaphuong');
 	}
}
