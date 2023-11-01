<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schools;
use App\Models\Departments;

class DepartmentController extends Controller
{
    //show add department form
    public function showadddepartment(){
        $schools = Schools::all();
        return view('superadmindashboard.adddepartment',compact('schools'));
    }

    //To validate and insert department into the system
    public function insertdepartment(Request $request){
        $request->validate(
            [
                'name'=>'required',
                'school'=>'required',
                
                
            ]
            );
            $Department=new Departments;
            
            $requestedname = $request['name'];
            
            // Check if the name already exists in the database
            $existingname = Departments::where('name', $requestedname)->first();
            
            if ($existingname) {
                // Name already taken, show a message or take appropriate action
                return redirect()->route('adddepartment')->withError('This name has already been taken');
                
            } else {
                // Assign the name
            $Department->name=$requestedname;
            $schoolid = Schools::where('name',$request['school'])->first();
            $Department->school_id=$schoolid->school_id;
            $Department->save();
            return redirect('/superadmin');
       
        }}
}
