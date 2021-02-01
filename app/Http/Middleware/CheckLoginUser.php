<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;
use Closure;

class CheckLoginUser extends Middleware
{
    public function handle($request, Closure $next){
    	if(!get_data_user('web')){
    		return redirect()->route('get.login');
    	}
    	return $next($request);
   	}
}
