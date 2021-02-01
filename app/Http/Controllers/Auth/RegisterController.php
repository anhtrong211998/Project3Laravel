<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Feeship;
use App\City;
use App\Province;
use App\Wards;
use App\FeeUser;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    public function ShareModelOther(){

        $cities=City::all();
        $provinces=Province::all();
        $wards=Wards::all();
        // $brand = Brand::all();
        return view()->share(['cities'=>$cities,'provinces'=>$provinces,'wards'=>$wards]);
    }
    public function getRegister(){
        $this->ShareModelOther();
        return view('auth.register');
    }
    public function postRegister(StoreUserRequest $request){ 

       
       $user = new User();
       $user->name=$request->name;
       $user->phone=$request->phone;
       $user->email=$request->email;
       $user->password=bcrypt($request->password);
       $get_image = $request->file('avatar');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('article',$new_image);
            $datas->avatar = $new_image;   
        }
       $user->save();

       if($user->id){
        $fee_user = new FeeUser();
        $fee_user->f_u_user_id=$user->id;
        $feeship = Feeship::where('fee_matp',$request->fee_matp)->where('fee_maquanhuyen',$request->fee_maquanhuyen)->where('fee_maxaphuong',$request->fee_maxaphuong)->first();
        if($feeship){
            $fee_user->f_u_fee_id=$feeship->fee_id;
        }
        else{
            $fee_user->f_u_fee_id=0;
        }
        $fee_user->f_u_address=$this->render_address_user($request->f_u_address,$request->fee_maxaphuong,$request->fee_maquanhuyen,$request->fee_matp);
        $fee_user->save();
        return redirect()->route('get.login');
       }
       return redirect()->back();
    }
    public function render_address_user($f_u_address,$fee_maxaphuong,$fee_maquanhuyen,$fee_matp){
        $city_name = City::find($fee_matp)->name;
        $province_name = Province::find($fee_maquanhuyen)->name;
        $wards_name = Wards::find($fee_maxaphuong)->name;
        return $f_u_address.','.$wards_name.','.$province_name.','.$city_name;
    }
}
