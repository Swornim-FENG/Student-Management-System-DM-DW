<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    public function login(Request $request)
    {
        
         
         $credentials = $request->only('email', 'password');
         
         try{
         if (Auth::once($credentials)) {
         //  $request->session()->regenerate();
        //    dd(Auth::user()->user_id);
         //  session('userId',Auth::user());
          // dd(Auth::user());
          $request->session()->put('user', Auth::user());
           if(Auth::user()->role_id==1){
                 return redirect()->intended('/superadmin');

           }else if(Auth::user()->role_id==2){
                 
                  return redirect()->intended('/admin');
           }
           else if(Auth::user()->role_id==4){
                 
            return redirect()->intended('/professor');
     }
           
        }
        else{
            return redirect()->route('login')->withError('Invalid email or password.');
        }}
        catch(\Exception $e){
            dd($e);

        }
        
        
    }
    
    public function loginpage(){
        return view('login');
    }

    public function logout(){
        auth()->logout();
        return redirect('/login');
     }
}
