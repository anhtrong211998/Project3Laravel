<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    //
    protected $fillable = [
    	'banner_desc', 'banner_image','category_banner_id','banner_status'
    ];
    protected $primaryKey = 'banner_id';
 	protected $table = 'tbl_banner';
}
