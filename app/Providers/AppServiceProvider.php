<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Category;
use App\Cart;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer('userpages.layout.navbar',function($view){
        	$menu = Category::where('category_status','1')->get();
        	$view->with('loai_sp',$menu);
        });
        if (!Collection::hasMacro('paginate')) {

            Collection::macro('paginate',function ($perPage = 15, $page = null, $options = []){
                $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
                return (new LengthAwarePaginator(
                    $this->forPage($page, $perPage), $this->count(), $perPage, $page, $options))->withPath('');
            });
        }

        
    }
}
