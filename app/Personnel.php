<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    //
    protected $table =  'tbl_personnel';
    //khai bao khoa chinh
    protected $primaryKey = 'personnel_id';
    protected $fillable=[
        'personnel_name',
        'personnel_phone',
        'personnel_email',
        'personnel_sex',
        'personnel_address',
        'personnel_position',
        'personnel_birth',

    ];
    // public function Order(){
    //     return $this->hasMany('App\Rating','rating_product_id','product_id');
    // }
}
