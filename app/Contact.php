<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    protected $table='tbl_contact';
    protected $primaryKey='contact_id';
    protected $fillable=[
    	'contact_name',
    	'contact_title',
    	'contact_content',
    	'contact_email',
    	'contact_company',
    	'contact_phone',
    	'contact_address'

    ];
}
