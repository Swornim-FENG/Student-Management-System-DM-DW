<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departments;
use App\Models\Programs;

class ProgramController extends Controller
{
    //show add program form
    public function showaddprogram(){
        $departments = Departments::all();
        return view('superadmindashboard.addprogram',compact('departments'));
    }
     //To validate and insert program into the system
     public function insertprogram(Request $request){
        $request->validate(
            [
                'name'=>'required',
                'department'=>'required',
                
                
            ]
            );
            $Program=new Programs;
            
            $requestedname = $request['name'];
            
            // Check if the name already exists in the database
            $existingname = Programs::where('name', $requestedname)->first();
            
            if ($existingname) {
                // Name already taken, show a message or take appropriate action
                return redirect()->route('addprogram')->withError('This name has already been taken');
                
            } else {
                // Assign the name
            $Program->name=$requestedname;
            $departmentid = Departments::where('name',$request['department'])->first();
            $Program->dep_id=$departmentid->dep_id;
            $Program->save();
            return redirect('/superadmin');
       
        }}
}
