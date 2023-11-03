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
            $course = new Courses;
$requestedprofessor = $request['professor_email'];

// Check if the professor's email exists in the database
$existingemail = User::where('email', $requestedprofessor)->first();

if ($existingemail) {
    // Assign course details
    $course->name = $request['name'];
    $course->course_code = $request['code'];
    $course->cr_hour = $request['credit_hour'];
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
        $course->save();
        $departmentid = Departments::where('name', $request['department'])->first();
        $lastInsertedcourseId = $course->getKey();

        foreach ($studentIds as $studentId) {
            $cusers = new Course_users;
            $cusers->prof_id = $existingemail->user_id;
            $cusers->dep_id = $departmentid->dep_id;
            $cusers->course_id = $lastInsertedcourseId;
            $cusers->stud_id = $studentId;
            $cusers->save();
        }

        return redirect('/superadmin/course');
    } else {
        // Handle the case where some student emails do not exist
        $errorMessage = 'The following student emails do not exist: ' . implode(', ', $nonExistentStudentEmails);
        return redirect()->route('addcourse')->withError($errorMessage);
    }
} else {
    // Handle the case where the professor's email does not exist
    return redirect()->route('addcourse')->withError('The email of the professor does not exist');
}
            
        }
}
