<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Departments;
use App\Models\Course_users;
use App\Models\User;

class CourseController extends Controller
{
    //show course page of superadmin dashboard
    public function showcourse(){
        return view('superadmindashboard.course');
    }
    //show add course form of superadmin dashboard
    public function addcourse(){
        $departments = Departments::all();
        return view('superadmindashboard.addcourse',compact('departments'));
    }

    //To validate and insert course into the system
    public function insertcourse(Request $request){
        $request->validate(
            [
                'name'=>'required',
                'code'=>'required',
                'credit_hour'=>'required',
                'professor_email'=>'required|email',
                'department'=>'required',
            ]
            );
            
            $course=new Courses;
            $cusers=new Course_users;
            $requestedprofessor = $request['professor_email'];
            
            // Check if the email exists in the database
            $existingemail = User::where('email', $requestedprofessor)->first();
            
            if($existingemail) {
            //Assign            
            $course->name=$request['name'];
            $course->course_code=$request['code'];
            $course->cr_hour=$request['credit_hour'];
            $course->save();
            $departmentid = Departments::where('name',$request['department'])->first();
            $cusers->dep_id=$departmentid->dep_id;
            $lastInsertedcourseId = $course->getKey();
            $cusers->course_id=$lastInsertedcourseId;
            $cusers->prof_id=$existingemail->user_id;
            $cusers->save();
            $studentEmails = $request['student_emails'];
            $studentIds= User::whereIn('email', $studentEmails)->pluck('user_id');
            foreach ($studentIds as $studentId) {
                $cusers=new Course_users;
                $cusers->stud_id=$studentId;
                $cusers->save();
                }
            return redirect('/superadmin/course');}
            else {
                // Email doesnot exists, show a message or take appropriate action
                return redirect()->route('addcourse')->withError('The email of the professor doesnot exists');}

        }
}
