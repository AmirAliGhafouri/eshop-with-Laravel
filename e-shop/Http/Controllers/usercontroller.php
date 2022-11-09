<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class usercontroller extends Controller
{
   
//_________sign in 
    function signin(Request $req){
        $req->validate([
            'name'=>'required',
            'email'=>'required | unique:users',
            'pswd'=>'required | min:4'
        ]);
        $user=user::where(['email'=>$req->email])->first();
        if($user){
            return view('signin',['error'=>'حساب کاربری دیگری با این ایمیل وجود دارد']);
        }

        user::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'admin'=>0,
            'password'=>Hash::make($req->pswd)
        ]);

        return view('login',['account'=>'ثبت نام شما با موفقیت انجام شد اکنون می توانید به حساب کاربری خود ورود کنید']);     
    }

//_________Login
    function login(Request $req){
        $user=user::where(['email'=>$req->email])->first();
        if($user && Hash::check($req->pswd,$user->password)){
            $req->session()->put('user',$user);
            return redirect('/');
        }

        else{
            return view('login', ['login_error'=>'ایمیل یا رمز عبور اشتباه است']);
        }
    }

//_________Logout
    function logout(){
        Session::forget('user');
        return redirect('/');
    }

//_________ Edit user info
    function user_info_edit(Request $req){
       
        $user_id=Session::get('user')['id'];
        if($req->name){
            user::where('id' , $user_id)->update(['name'=>$req->name]);
        }

        if($req->email){
            $req->validate([
                'email'=>'unique:users',
            ]);

            user::where('id' , $user_id)->update(['email'=>$req->email]);
        }

        return back()->withInput();    
    }
}
