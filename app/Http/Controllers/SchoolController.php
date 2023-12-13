<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schools;

class SchoolController extends Controller
{
    //show add school form
    public function showaddschool(){
        return view('superadmindashboard.addschool');
    }

    //To validate and insert school into the system
    public function insertschool(Request $request){
        $request->validate(
            [
                'name'=>'required',
                'location'=>'required',
                
                
            ]
            );
            $school=new Schools;
            
            $requestedname = $request['name'];
            
            // Check if the name already exists in the database
            $existingname = Schools::where('name', $requestedname)->first();
            
            if ($existingname) {
                // Name already taken, show a message or take appropriate action
                return redirect()->route('addschool')->withError('This name has already been taken');
                
            } else {
                // Assign the name
            $school->name=$requestedname;
            $school->location=$request['location'];
            $school->save();
            return redirect('/superadmin/school');
       
        }}
}
