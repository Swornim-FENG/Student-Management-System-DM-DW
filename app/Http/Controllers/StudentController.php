<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\User;


class StudentController extends Controller
{   
    //To show add students form 
    public function addstudents(){
        return view('admindashboard.addstudents');
    }
    
    //To validate and insert students into the system
    public function insertstudents(Request $request){
        $request->validate(
            [
                'first_name'=>'required',
                'last_name'=>'required',
                'per_address'=>'required',
                'tem_address'=>'required',
                'email'=>'required|email',
                'SID'=>'required',
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
                return redirect()->route('student')->withError('This email has already been taken');
                
            } else {
                // Assign the email to the user
                $user->email = $requestedEmail;

            $user->password=\Hash::make($request['password']);
            $user->role_id=4;
           
            $student=new Students;
            $student->Firstname=$request['first_name'];
            $student->Lastname=$request['last_name'];

            $requestedreg = $request['SID'];
             // Check if the Regisration number already exists in the database
             $existingreg = Students::where('registration_no', $requestedreg)->first();
            
             if ($existingreg) {
                 // Registration number already taken, show a message or take appropriate action
                 return redirect()->route('student')->withError('This registration number has already been taken');
                 
             } else {
                 // Assign the Registration number to the user  
            $student->registration_no= $requestedreg;
            $user->save();
            $student->permanent_address=$request['per_address'];
            $student->temporary_address=$request['tem_address'];
            $lastInsertedUserId = $user->getKey();
            $student->user_id=$lastInsertedUserId;
            $student->save();
            return redirect('/admin');
       
        }}}
}
