<?php  
namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;
use Closure;

class CheckLoginAdmin
{
    public function handle($request, Closure $next){
    	if(!get_data_user('admins')){
    		return redirect()->route('admin.login');
    	}
    	return $next($request);
   	}
}