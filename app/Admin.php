<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    //
    use Notifiable;
    protected $fillable = [
        'email','password','active','role'
    ];
    protected $guarded = ['*'];
    protected $hidden = [
        'password',
    ];
}
