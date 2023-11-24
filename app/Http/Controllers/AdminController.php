<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admins;
use App\Models\User;

class AdminController extends Controller
{
    //show admin dashboard
    public function showadmin(){
        return view('admindashboard.admindashboard');
    }
    //show add admin form
    public function showaddadmin(){
        return view('superadmindashboard.addadmin');
    }

    public function insertadmin(Request $request){
        $request->validate(
            [
                'first_name'=>'required',
                'last_name'=>'required',
                'per_address'=>'required',
                'tem_address'=>'required',
                'phone_number'=>'required|digits:10',
                'email'=>'required|email',
                'password'=>'required',
                
            ]
            );
            $user=new User;
            $user->Fullname = $request['first_name'] . ' ' . $request['last_name'];
            
            $requestedEmail = $request['email'];
            
            // Check if the email already exists in the database
            $existingEmail = User::where('email', $requestedEmail)->first();
            
            if ($existingEmail) {
                // Email already taken, show a message or take appropriate action
                return redirect()->route('addadmin')->withError('This email has already been taken');
                
            } else {
                // Assign the email to the user
                $user->email = $requestedEmail;

            $user->password=\Hash::make($request['password']);
            $user->role_id=2;
            $user->phone_number=$request['phone_number'];
            $user->save();
            $admins=new Admins;
            $admins->Firstname=$request['first_name'];
            $admins->Lastname=$request['last_name'];
            $admins->permanent_address=$request['per_address'];
            $admins->temporary_address=$request['tem_address'];
            $lastInsertedUserId = $user->getKey();
            $admins->user_id=$lastInsertedUserId;
            $admins->save();
            return redirect('/superadmin');
       
        }}
}
