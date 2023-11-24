<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professors;
use App\Models\User;
class ProfessorController extends Controller
{   
    //To show add professor form of admin dashboard
    public function addprofessors(){
        return view('admindashboard.addprofessors');
    }
    // To show professor dashboard
    public function showprofessors(){
        return view('professordashboard.professordashboard');
    }

    //To validate and insert students into the system
    public function insertprofessors(Request $request){
        $request->validate(
            [
                'first_name'=>'required',
                'last_name'=>'required',
                'permanent_address'=>'required',
                'temporary_address'=>'required',
                'email'=>'required|email',
                'password'=>'required',
                'phone_number'=>'required',
                
            ]
            );
            $user=new User;
            $user->Fullname = $request['first_name'] . ' ' . $request['last_name'];
            
            $requestedEmail = $request['email'];
            
            // Check if the email already exists in the database
            $existingEmail = User::where('email', $requestedEmail)->first();
            
            if ($existingEmail) {
                // Email already taken, show a message or take appropriate action
                return redirect()->route('professor')->withError('This email has already been taken');
                
            } else {
                // Assign the email to the user
                $user->email = $requestedEmail;

            $user->password=\Hash::make($request['password']);
            $user->role_id=3;
            $user->phone_number=$request['phone_number'];
            $user->save();
            $professors=new Professors;
            $professors->Firstname=$request['first_name'];
            $professors->Lastname=$request['last_name'];
            $professors->permanent_address=$request['permanent_address'];
            $professors->temporary_address=$request['temporary_address'];
            $lastInsertedUserId = $user->getKey();
            $professors->user_id=$lastInsertedUserId;
            $professors->save();
            return redirect('/admin');
       
        }}

        //To show add professor form of superadmin dashboard
    public function add_professors(){
        return view('superadmindashboard.addprofessors');
    }

    //To validate and insert students into the system
    public function insert_professors(Request $request){
        $request->validate(
            [
                'first_name'=>'required',
                'last_name'=>'required',
                'permanent_address'=>'required',
                'temporary_address'=>'required',
                'email'=>'required|email',
                'password'=>'required',
                'phone_number'=>'required',
                
            ]
            );
            $user=new User;
            $user->Fullname = $request['first_name'] . ' ' . $request['last_name'];
            
            $requestedEmail = $request['email'];
            
            // Check if the email already exists in the database
            $existingEmail = User::where('email', $requestedEmail)->first();
            
            if ($existingEmail) {
                // Email already taken, show a message or take appropriate action
                return redirect()->route('add_professor')->withError('This email has already been taken');
                
            } else {
                // Assign the email to the user
                $user->email = $requestedEmail;

            $user->password=\Hash::make($request['password']);
            $user->role_id=3;
            $user->phone_number=$request['phone_number'];
            $user->save();
            $professors=new Professors;
            $professors->Firstname=$request['first_name'];
            $professors->Lastname=$request['last_name'];
            $professors->permanent_address=$request['permanent_address'];
            $professors->temporary_address=$request['temporary_address'];
            $lastInsertedUserId = $user->getKey();
            $professors->user_id=$lastInsertedUserId;
            $professors->save();
            return redirect('/superadmin');
       
        }}
}
