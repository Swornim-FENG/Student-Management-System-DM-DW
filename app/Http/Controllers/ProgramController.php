<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departments;
use App\Models\Courses;
use App\Models\Programs;
use App\Models\Students;
use App\Models\Professors;
use App\Models\User;
use App\Models\Program_professors;
use App\Models\Program_admins;
use App\Models\Admins;
use Illuminate\Support\Facades\Auth;
use App\Models\Schools;

class ProgramController extends Controller
{
    //show program page of superadmin dashboard
    public function showProgram()
{
    $programCount = Programs::count();

    // Step 1: Retrieve all programs
    $programs = Programs::all();

    // Step 2: Retrieve corresponding departments based on dep_id
    $programIds = $programs->pluck('dep_id')->toArray();
    $departments = Departments::whereIn('dep_id', $programIds)->get();

    // Step 3: Retrieve corresponding schools based on the department's school_id
    $schoolIds = $departments->pluck('school_id')->toArray();
    $schools = Schools::whereIn('school_id', $schoolIds)->get();

    return view('superadmindashboard.programpage', compact('programCount'), [
        'programs' => $programs,
        'departments' => $departments,
        'schools' => $schools,
    ]);
}

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
            return redirect('/superadmin/program');
       
        }}

        //show add student to program form of superadmin dashboard
    public function showadd_student_toprogram(){
        $programs = Programs::all();
        return view('superadmindashboard.addstudent_toprogram',compact('programs'));
    }

     //show add student to program form of admin dashboard
     public function show_add_student_toprogram(Request $request){
        $userObj = $request->session()->get("user");
        $userId=$userObj->user_id;
        $programid=Program_admins::where('admin_id',$userId)->first();
        $program =Programs::where('program_id',$programid->program_id)->first();
        return view('admindashboard.addstudent_toprogram',compact('program'));
    }


    //To validate and insert students into program 
    public function insert_student_toprogram(Request $request){
               
            $studentEmails = $request['student_emails'];

            $studentIds = [];
    $nonExistentStudentEmails = [];

    // Check if each student email exists
    foreach ($studentEmails as $studentEmail) {
        $student = User::where('email', $studentEmail)->first();

        if ($student) {
            $studentIds[] = $student->user_id;
        } else {
            $nonExistentStudentEmails[] = $studentEmail;
            }
         }     
         if (empty($nonExistentStudentEmails)) {
            $programid = Programs::where('name',$request['program'])->first();
    
            foreach ($studentIds as $studentId) {
                $student = Students::find($studentId);
                $student->program_id = $programid->program_id;
                $student->save();
            }
    
            return redirect('/superadmin');
        } else {
            // Handle the case where some student emails do not exist
            $errorMessage = 'The following student emails do not exist: ' . implode(', ', $nonExistentStudentEmails);
            return redirect()->route('add_student_toprogram')->withError($errorMessage);
        }
            
            
       
        }

        //To validate and insert students into program 
    public function insert_stud_ent_toprogram(Request $request){
               
        $studentEmails = $request['student_emails'];

        $studentIds = [];
$nonExistentStudentEmails = [];

// Check if each student email exists
foreach ($studentEmails as $studentEmail) {
    $student = User::where('email', $studentEmail)->first();

    if ($student) {
        $studentIds[] = $student->user_id;
    } else {
        $nonExistentStudentEmails[] = $studentEmail;
        }
     }     
     if (empty($nonExistentStudentEmails)) {
        $programid = Programs::where('name',$request['program'])->first();

        foreach ($studentIds as $studentId) {
            $student = Students::find($studentId);
            $student->program_id = $programid->program_id;
            $student->save();
        }

        return redirect('/admin');
    } else {
        // Handle the case where some student emails do not exist
        $errorMessage = 'The following student emails do not exist: ' . implode(', ', $nonExistentStudentEmails);
        return redirect()->route('add_stud_ent_toprogram')->withError($errorMessage);
    }
        
        
   
    }

        //show add professor to program form of superadmin dashboard
    public function showadd_professor_toprogram(){
        $programs = Programs::all();
        return view('superadmindashboard.addprofessor_toprogram',compact('programs'));
    }

    //show add professor to program form of admin dashboard
    public function show_add_professor_toprogram(Request $request){
        $userObj = $request->session()->get("user");
        $userId=$userObj->user_id;
        $programid=Program_admins::where('admin_id',$userId)->first();
        $program =Programs::where('program_id',$programid->program_id)->first();
        return view('admindashboard.addprofessor_toprogram',compact('program'));
    }

    //To validate and insert professor into program 
    public function insert_professor_toprogram(Request $request){
        $request->validate(
            [
                
                'professor_email'=>'required|email',
                
                
            ]
            );
            $program_professor = new Program_professors;
      $requestedprofessor = $request['professor_email'];

// Check if the professor's email exists in the database
$existingemail = User::where('email', $requestedprofessor)->first();
$existingid=Professors::find($existingemail->user_id);
      if ($existingid) {
          // Assign  
          $programid = Programs::where('name',$request['program'])->first();
           $program_professor->program_id=$programid->program_id;
           $program_professor->prof_id=$existingid->user_id;
           $program_professor->save();
           return redirect('/superadmin');
            
}
else {
    // Handle the case where the professor's email does not exist
    return redirect()->route('add_professor_toprogram')->withError('The email of the professor does not exist');

       
        }}

        //To validate and insert professor into program 
    public function insert_prof_essor_toprogram(Request $request){
        $request->validate(
            [
                
                'professor_email'=>'required|email',
                
                
            ]
            );
            $program_professor = new Program_professors;
      $requestedprofessor = $request['professor_email'];

// Check if the professor's email exists in the database
$existingemail = User::where('email', $requestedprofessor)->first();
$existingid=Professors::find($existingemail->user_id);
      if ($existingid) {
          // Assign  
          $programid = Programs::where('name',$request['program'])->first();
           $program_professor->program_id=$programid->program_id;
           $program_professor->prof_id=$existingid->user_id;
           $program_professor->save();
           return redirect('/admin');
            
}
else {
    // Handle the case where the professor's email does not exist
    return redirect()->route('add_prof_essor_toprogram')->withError('The email of the professor does not exist');

       
        }}

        //show add admin to program form of superadmin dashboard
    public function showadd_admin_toprogram(){
        $programs = Programs::all();
        return view('superadmindashboard.addadmin_toprogram',compact('programs'));
    }

    //To validate and insert admin into program 
    public function insert_admin_toprogram(Request $request){
        $request->validate(
            [
                
                'admin_email'=>'required|email',
                
                
            ]
            );
            $program_admin = new Program_admins;
      $requestedadmin = $request['admin_email'];

// Check if the admin's email exists in the database
$existingemail = User::where('email', $requestedadmin)->first();
if($existingemail){
$existingid=Admins::find($existingemail->user_id);
if ($existingid) {
$existingadminid=Program_admins::where('admin_id', $existingid->user_id)->first();
if($existingadminid){
    // Handle the case where the admin is already assigned to a program
    return redirect()->route('add_admin_toprogram')->withError('The admin is already assigned to a program');
}
else{
      
          // Assign  
          $programid = Programs::where('name',$request['program'])->first();
           $program_admin->program_id=$programid->program_id;
           $program_admin->admin_id=$existingid->user_id;
           $program_admin->save();
           return redirect('/superadmin');
            
}}
else {
    // Handle the case where the admin's email does not exist
    return redirect()->route('add_admin_toprogram')->withError('The email of the admin does not exist');

       
        }}
        else {
            // Handle the case where the email does not exist
            return redirect()->route('add_admin_toprogram')->withError('The email of the admin does not exist');
    }}

}
