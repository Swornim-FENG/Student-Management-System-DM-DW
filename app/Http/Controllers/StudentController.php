<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Course_students;
use App\Models\Courses;
use App\Models\Course_professors;

class StudentController extends Controller
{    

    //To show students dashboard 
    public function showstudent(Request $request){
        $userObj = $request->session()->get("user");
        $userId=$userObj->user_id;
        $student=Students::where('user_id',$userId)->first();
        return view('studentdashboard.studentdashboard',compact('student'));
    }

    //To show grades page of student dashboard 
    public function students_grades(Request $request){
        $userObj = $request->session()->get("user");
        $userId=$userObj->user_id;
        $student=Students::where('user_id',$userId)->first();
        return view('studentdashboard.grades',compact('student'));
    }

    //To show courses page of student dashboard 
    public function students_courses(Request $request){
        $userObj = $request->session()->get("user");
        $userId=$userObj->user_id;
        $student = Students::where('user_id', $userId)->first();
$courseIds = Course_students::where('stud_id', $userId)->pluck('course_id');

// Fetch courses from the Courses table
$courses = Courses::whereIn('course_id', $courseIds)->get();

// Fetch course_students information
$courseStudentInfo = Course_students::whereIn('course_id', $courseIds)->get();

// Combine the information into a single collection
$combinedData = $courses->map(function ($course) use ($courseStudentInfo) {
    $info = $courseStudentInfo->where('course_id', $course->course_id)->first();
    return [
        'course' => $course,
        'courseStudentInfo' => $info,
    ];
});
        return view('studentdashboard.courses',compact('student','courses','combinedData'));
    }

     //To show individual course page of student dashboard 
     public function students_indcourse(Request $request,$course_id,$year,$sem,$batch){
        $userObj = $request->session()->get("user");
        $userId=$userObj->user_id;
        $student=Students::where('user_id',$userId)->first();
        $course=Courses::where('course_id',$course_id)->first();
        $professor = Course_professors::where([
            'course_id' => $course_id,
            'year' => $year,
            'sem' => $sem,
            'batch' => $batch,
        ])->first();
        
        if ($professor && $professor->prof_id !== null) {
            $profinfo = User::find($professor->prof_id);
            
            // Now $profinfo contains the user information or is null if the user is not found
        } else {
            // Handle the case where $professor is null or $professor->prof_id is null
            // For example, you might set $profinfo to null or some default value
            $profinfo = null;
        }
        return view('studentdashboard.individualcourse',compact('student','course','profinfo'));
    }

    //To show settings page of student dashboard 
    public function students_settings(Request $request){
        $userObj = $request->session()->get("user");
        $userId=$userObj->user_id;
        $student=Students::where('user_id',$userId)->first();
        return view('studentdashboard.settings',compact('student'));
    }

    //To show add students form of admin dashboard
    public function addstudents(){
        return view('admindashboard.addstudents');
    }
    
    //To validate and insert students into the system
    public function insertstudents(Request $request){
        $request->validate(
            [
                'first_name'=>'required',
                'last_name'=>'required',
                'permanent_address'=>'required',
                'temporary_address'=>'required',
                'email'=>'required|email',
                'registration_no'=>'required',
                'password'=>'required',
                'date_of_birth'=>'required',
                'phone_number'=>'required',
                'mother_name'=>'required',
                'father_name'=>'required',

                
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
            $user->phone_number=$request['phone_number'];
           
            $student=new Students;
            $student->Firstname=$request['first_name'];
            $student->Lastname=$request['last_name'];

            $requestedreg = $request['registration_no'];
             // Check if the Regisration number already exists in the database
             $existingreg = Students::where('registration_no', $requestedreg)->first();
            
             if ($existingreg) {
                 // Registration number already taken, show a message or take appropriate action
                 return redirect()->route('student')->withError('This registration number has already been taken');
                 
             } else {
                 // Assign the Registration number to the user  
            $student->registration_no= $requestedreg;
            $user->save();
            $student->permanent_address=$request['permanent_address'];
            $student->temporary_address=$request['temporary_address'];
            $student->Mother_name=$request['mother_name'];
            $student->Father_name=$request['father_name'];
            $student->dob=$request['date_of_birth'];
            $lastInsertedUserId = $user->getKey();
            $student->user_id=$lastInsertedUserId;
            $student->save();
            return redirect('/admin');
       
        }}}

        //To show add students form of superadmin dashboard 
    public function add_students(){
        return view('superadmindashboard.addstudents');
    }
    
    //To validate and insert students into the system
    public function insert_students(Request $request){
        $request->validate(
            [
                'first_name'=>'required',
                'last_name'=>'required',
                'permanent_address'=>'required',
                'temporary_address'=>'required',
                'email'=>'required|email',
                'registration_no'=>'required',
                'password'=>'required',
                'date_of_birth'=>'required',
                'phone_number'=>'required',
                'mother_name'=>'required',
                'father_name'=>'required',

                
            ]
            );
            $user=new User;
            $user->Fullname = $request['first_name'] . ' ' . $request['last_name'];
            
            $requestedEmail = $request['email'];
            
            // Check if the email already exists in the database
            $existingEmail = User::where('email', $requestedEmail)->first();
            
            if ($existingEmail) {
                // Email already taken, show a message or take appropriate action
                return redirect()->route('add_student')->withError('This email has already been taken');
                
            } else {
                // Assign the email to the user
                $user->email = $requestedEmail;

            $user->password=\Hash::make($request['password']);
            $user->role_id=4;
            $user->phone_number=$request['phone_number'];
           
            $student=new Students;
            $student->Firstname=$request['first_name'];
            $student->Lastname=$request['last_name'];

            $requestedreg = $request['registration_no'];
             // Check if the Regisration number already exists in the database
             $existingreg = Students::where('registration_no', $requestedreg)->first();
            
             if ($existingreg) {
                 // Registration number already taken, show a message or take appropriate action
                 return redirect()->route('add_student')->withError('This registration number has already been taken');
                 
             } else {
                 // Assign the Registration number to the user  
            $student->registration_no= $requestedreg;
            $user->save();
            $student->permanent_address=$request['permanent_address'];
            $student->temporary_address=$request['temporary_address'];
            $student->Mother_name=$request['mother_name'];
            $student->Father_name=$request['father_name'];
            $student->dob=$request['date_of_birth'];
            $lastInsertedUserId = $user->getKey();
            $student->user_id=$lastInsertedUserId;
            $student->save();
            return redirect('/superadmin');
       
        }} }
}
