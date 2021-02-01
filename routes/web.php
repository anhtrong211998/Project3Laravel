<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
//Router for admin pages
Route::prefix('authenticate')->group(function(){
	Route::get('/login','AdminAuthController@getLogin')->name('admin.login');
	Route::post('/login','AdminAuthController@postLogin');
	Route::get('/logout','AdminAuthController@getLogout')->name('get.logout.admin');
});
//////////
Route::group(['prefix'=>'admin','middleware'=>'\App\Http\Middleware\CheckLoginAdmin'],function(){
// Route::group(['prefix'=>'admin'],function(){
	//Router for admin/category
	Route::group(['prefix'=>'category'],function(){
		//update
		Route::get('list','Categorycontroller@list');
		Route::post('save','Categorycontroller@store');
		Route::get('edit/{id}','Categorycontroller@edit');
		Route::get('change-status/{id}','Categorycontroller@change_status');
		Route::get('delete/{id}','Categorycontroller@delete');
		Route::get('load-data','Categorycontroller@Load_Data');
	});
	//Router for admin/catetory
	Route::group(['prefix'=>'catetory'],function(){
		//update
		Route::get('list','Catetorycontroller@list');
		Route::post('save','Catetorycontroller@store');
		Route::get('edit/{id}','Catetorycontroller@edit');
		Route::get('change-status/{id}','Catetorycontroller@change_status');
		Route::get('delete/{id}','Catetorycontroller@delete');
		Route::get('load-data','Catetorycontroller@Load_Data');
	});
	//router for admin/brand
	Route::group(['prefix'=>'brand'],function(){
		//update
		Route::get('list','Brandcontroller@list');
		Route::post('save','Brandcontroller@store');
		Route::get('edit/{id}','Brandcontroller@edit');
		Route::get('change-status/{id}','Brandcontroller@change_status');
		Route::get('delete/{id}','Brandcontroller@delete');
		Route::get('load-data','Brandcontroller@Load_Data');
	});
	//router for admin/provider
	Route::group(['prefix'=>'provider'],function(){
		//update
		Route::get('list','Providercontroller@list');
		Route::post('save','Providercontroller@store');
		Route::get('edit/{id}','Providercontroller@edit');
		Route::get('change-status/{id}','Providercontroller@change_status');
		Route::get('delete/{id}','Providercontroller@delete');
		Route::get('load-data','Providercontroller@Load_Data');
		
	});
	//Router for admin/product
	Route::group(['prefix'=>'product'],function(){
		//update
		Route::get('list','Productcontroller@list');
		Route::get('getcatetory/{categoryID}','Productcontroller@get_catetory');
		Route::get('create','Productcontroller@getCreate');
		Route::post('save','Productcontroller@store');
		Route::get('edit/{id}','Productcontroller@edit');
		Route::post('edit/{id}','Productcontroller@update');
		Route::get('change-status/{id}','Productcontroller@change_status');
		Route::get('delete/{id}','Productcontroller@delete');
		Route::get('load-data','Productcontroller@Load_Data');
	});
	Route::group(['prefix'=>'coupon'],function(){
		//update
		Route::get('list','CouponController@list');
		Route::post('save','CouponController@store');
		Route::get('edit/{id}','CouponController@edit');
		// Route::get('change-status/{id}','CouponController@change_status');
		Route::get('delete/{id}','CouponController@delete');
		Route::get('load-data','CouponController@Load_Data');
	});
	Route::group(['prefix'=>'feeship'],function(){
		//update
		Route::get('getprovince/{matp}','FeeshipController@get_province');
		Route::get('getwards/{maqh}','FeeshipController@get_wards');
		Route::get('list','FeeshipController@list');
		Route::post('save','FeeshipController@store');
		Route::get('edit/{id}','FeeshipController@edit');
		// Route::get('change-status/{id}','FeeshipController@change_status');
		Route::get('delete/{id}','FeeshipController@delete');
		Route::get('load-data','FeeshipController@Load_Data');
	});
	Route::group(['prefix'=>'article'],function(){
		Route::get('list','ArticaleController@list')->name('admin.article.list');
		Route::get('create','ArticaleController@getCreate')->name('admin.article.get.create');
		Route::post('save','ArticaleController@store')->name('admin.article.post.save');
		Route::get('edit/{id}','ArticaleController@edit')->name('admin.article.get.edit');
		Route::post('edit/{id}','ArticaleController@update')->name('admin.article.post.edit');
		Route::get('change-status/{id}','ArticaleController@change_status');
		Route::get('delete/{id}','ArticaleController@delete_article');
		Route::get('load-data','ArticaleController@Load_Data');
	});
	Route::group(['prefix'=>'banner'],function(){
		Route::get('list','BannerController@list')->name('admin.banner.list');
		Route::post('save','BannerController@store')->name('admin.banner.post.save');
		Route::get('edit/{id}','BannerController@edit')->name('admin.banner.get.edit');
		Route::get('change-status/{id}','BannerController@change_status');
		Route::get('delete/{id}','BannerController@delete');
		Route::get('load-data','BannerController@Load_Data');

	});
	Route::group(['prefix'=>'user'],function(){
		Route::get('list','UserController@list')->name('admin.user.list');
		Route::post('save','UserController@store')->name('admin.user.post.save');
		Route::get('edit/{id}','UserController@edit')->name('admin.user.get.edit');
		Route::post('update/{id}','UserController@update')->name('admin.user.post.update');
		Route::get('change-status/{id}','UserController@change_status');
		Route::get('delete/{id}','UserController@delete');
		Route::get('load-data','UserController@Load_Data');
		
	});
	Route::group(['prefix'=>'user_fee'],function(){
		Route::get('view-feeship/{id}','FeeUserController@view');
		Route::post('save','FeeUserController@store');
		Route::get('edit/{id}','FeeUserController@edit');
		Route::post('test','FeeUserController@test')->name('admin.user_fee.post.test');
		Route::get('change-status/{id}','FeeUserController@change_status');
		Route::get('delete/{id}','FeeUserController@delete');
		Route::post('search','FeeUserController@search');
		// Route::get('view-feeship/{id}','FeeUserController@view');
	});
	Route::group(['prefix'=>'customer'],function(){
		//update
		Route::get('list','CustomerController@list');
		Route::post('save','CustomerController@store');
		Route::get('edit/{id}','CustomerController@edit');
		// Route::get('change-status/{id}','CustomerController@change_status');
		Route::get('delete/{id}','CustomerController@delete');
		Route::get('load-data','CustomerController@Load_Data');
	});
	Route::group(['prefix'=>'personnel'],function(){
		//update
		Route::get('list','PersonnelController@list');
		Route::post('save','PersonnelController@store');
		Route::get('edit/{id}','PersonnelController@edit');
		// Route::get('change-status/{id}','PersonnelController@change_status');
		Route::get('delete/{id}','PersonnelController@delete');
		Route::get('load-data','PersonnelController@Load_Data');
	});
	Route::group(['prefix'=>'account'],function(){
		//update
		Route::get('list','AccountController@list');
		Route::post('save','AccountController@store');
		Route::get('edit/{id}','AccountController@edit');
		Route::get('change-status/{id}','AccountController@change_status');
		Route::get('delete/{id}','AccountController@delete');
		Route::get('load-data','AccountController@Load_Data');
	});
	Route::group(['prefix'=>'order'],function(){
		//update
		// Route::get('list','OrderController@list');
		Route::get('list_default','OrderController@list_default');
		Route::get('list_info','OrderController@list_info');
		Route::get('list_warning','OrderController@list_warning');
		Route::get('list_success','OrderController@list_success');
		Route::get('list_danger','OrderController@list_danger');
		// Route::post('save','OrderController@store');
		// Route::get('edit/{id}','OrderController@edit');
		Route::get('change-status/{id}','OrderController@change_status');
		// Route::get('delete/{id}','OrderController@delete');
		Route::get('load-data','OrderController@Load_Data');
	});

	Route::group(['prefix'=>'orderdetail'],function(){
		Route::get('view-order/{id}','OrderDetailController@view');
		// Route::post('save','OrderDetailController@store');
		// Route::get('edit/{id}','OrderDetailController@edit');
		// Route::post('test','OrderDetailController@test')->name('admin.user_fee.post.test');
		// Route::get('change-status/{id}','OrderDetailController@change_status');
		// Route::get('delete/{id}','OrderDetailController@delete');
		// Route::post('search','OrderDetailController@search');
		// Route::get('view-feeship/{id}','OrderDetailController@view');
	});
	// Route::get('login','AdminController@loginForm');
	Route::get('dashboard','AdminController@show_dashboard')->name('admin.dashboard');
	// Route::post('login','AdminController@post_login');
	// Route::get('logout','AdminController@admin_logout');
});
//end router for admin
//router for pages-user
Route::group(['prefix'=>'home'],function(){
	Route::get('/','Homecontroller@index')->name('home');
	Route::get('/about','Homecontroller@about');
	Route::get('/faqs','Homecontroller@faqs');
	Route::get('/blog','Homecontroller@blog');
	Route::get('/blog_posts_table_view','Homecontroller@blog_posts_table_view');
	Route::get('/blog_single_post','Homecontroller@blog_single_post');
	Route::get('/contact_us','Homecontroller@contact_us');
	Route::post('/submit_contact_us','Homecontroller@submit_contact_us');
	Route::get('/sitemap','Homecontroller@sitemap');
	Route::get('/terms','Homecontroller@terms');
	Route::get('/policies','Homecontroller@policies');
	Route::get('/product_detail/{id}','GetProductController@details_product');
	Route::get('/get-product-category-/{id}','GetProductController@get_pro_cate');
	Route::get('/product/catetory/{id}','GetProductController@cate_product');
	Route::get('/product/brand/{id}','GetProductController@brand_product');
	Route::get('/articale','Homecontroller@get_aticale');
	Route::get('/articale_detail/{id}','Homecontroller@articale_detail');
	Route::post('/search/{name_search}','Homecontroller@name_product');
});
//router for cart
Route::get('/add-to-cart/{id}','CartController@addCart');
Route::get('/delete-item-cart/{id}','CartController@deleteitemCart');
Route::get('/load_cart','CartController@load_cart');
//router for checkout pages
Route::group(['prefix'=>'cart'],function(){
	Route::get('/checkout','CheckoutController@show_checkout');
	Route::get('/edit-item-cart/{id}/{quanty}','CheckoutController@editCart');
	Route::get('/delete-item-checkout-cart/{id}','CheckoutController@delete_itemcheckoutCart');
	Route::post('/apply-coupon/{coupon_code}','CheckoutController@apply_coupon');
	Route::post('/apply-coupon-payment/{coupon_code}','CheckoutController@apply_coupon_payment');
	Route::get('/clear-coupon','CheckoutController@clear_coupon');
	Route::get('/order_view/{id}','CheckoutController@order_view')->name('user.checkout.view');
	Route::get('/clear-coupon-payment','CheckoutController@clear_coupon_payment');
	Route::get('/cart_payment','CheckoutController@cart_payment');
	Route::get('/load_checkout','CheckoutController@load_checkout');
	Route::get('/load_payment','CheckoutController@load_payment');
	Route::get('/load_payment_user','CheckoutController@load_payment_user');
	Route::get('/apply-delevery','CheckoutController@apply_delevery');
	Route::post('/confirm_order','PaymentController@confirm_order1');
	Route::get('/user_cart_payment','CheckoutController@user_cart_payment');
	Route::post('/user_confirm_order','PaymentController@user_confirm_order');
});


Route::post('/submit-comment/{product_id}','RatingController@submit_comment')->middleware('\App\Http\Middleware\CheckLoginUser')->name('post.comment');
Route::group(['namespace'=>'Auth'],function(){
	//register
	Route::get('dang-ky','RegisterController@getRegister')->name('get.register');
	Route::post('dang-ky','RegisterController@postRegister')->name('post.register');
	//login
	Route::get('dang-nhap','LoginController@getLogin')->name('get.login');
	Route::post('dang-nhap','LoginController@postLogin')->name('post.login');
	Route::get('dang-xuat','LoginController@getLogout')->name('get.logout.user');
});
