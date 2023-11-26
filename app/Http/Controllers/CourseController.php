<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Departments;
use App\Models\Course_users;
use App\Models\User;
use App\Models\Programs;
use App\Models\Program_courses;
use App\Models\Course_students;
use App\Models\Course_professors;
use App\Models\Professors;

class CourseController extends Controller
{
    //show course page of superadmin dashboard
    public function showcourse(){
        return view('superadmindashboard.course');
    }
    //show course page of admin dashboard
    public function show_course(){
        return view('admindashboard.course');
    }
    // show add course form of superadmin dashboard
    // public function addcourse(){
    //     $departments = Departments::all();
    //     return view('superadmindashboard.addcourse',compact('departments'));
    // }

    //show add course form of superadmin dashboard
    public function addcourse(){
        return view('superadmindashboard.addcourse');
    }

    //show add course form of admin dashboard
    public function add_course(){
        return view('admindashboard.addcourse');
    }

    //To validate and insert course into the system
    public function insertcourse(Request $request){
        $request->validate(
            [
                'name'=>'required',
                'code'=>'required',
                'credit_hour'=>'required',
                'course_description'=>'required',
                
                
            ]
            );
            $course = new Courses;

             // Assign course details
             $course->name = $request['name'];
             $course->course_code = $request['code'];
             $course->cr_hour = $request['credit_hour'];
             $course->course_desc = $request['course_description'];
    
               $course->save();
        

        return redirect('/superadmin/course');
    
            
        }

        //To validate and insert course into the system
    public function insert_course(Request $request){
        $request->validate(
            [
                'name'=>'required',
                'code'=>'required',
                'credit_hour'=>'required',
                'course_description'=>'required',
                
                
            ]
            );
            $course = new Courses;

             // Assign course details
             $course->name = $request['name'];
             $course->course_code = $request['code'];
             $course->cr_hour = $request['credit_hour'];
             $course->course_desc = $request['course_description'];
    
               $course->save();
        

        return redirect('/admin/course');
    
            
        }
        //show assign course to program form of superadmin dashboard
    public function assign_course(){
        $programs = Programs::all();
        $courses = Courses::all();
        return view('superadmindashboard.assigncourse_toprogram',compact('programs','courses'));
    }

    //To validate and assign course into the program
    public function assign_course_toprogram(Request $request){
        
            $program_course = new Program_courses;
            $courseid=Courses::where('course_code',$request['course'])->first();
            $programid=Programs::where('name',$request['program'])->first();
    // Assign course details
    $program_course->program_id = $programid->program_id;
    $program_course->course_id = $courseid->course_id;
    
        $program_course->save();
        
        return redirect('/superadmin/course');
    
            
        }

        //show assign student to course form of superadmin dashboard
    public function assign_student(){
        $courses = Courses::all();
        return view('superadmindashboard.assignstudent_tocourse',compact('courses'));
    }

    //To validate and assign student into the course
    public function assign_student_tocourse(Request $request){
        $request->validate(
            [
                'batch'=>'required',
                
            ]
            );
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
                $courseid=Courses::where('course_code',$request['course'])->first();
                
        
                foreach ($studentIds as $studentId) {
                    $course_student=new Course_students;
                    $course_student->course_id=$courseid->course_id;
                    $course_student->stud_id=$studentId;
                    $course_student->year=$request['year'];
                    $course_student->sem=$request['sem'];
                    $course_student->batch=$request['batch'];
                    $course_student->save();
                }
        
                return redirect('/superadmin/course');
            } else {
                // Handle the case where some student emails do not exist
                $errorMessage = 'The following student emails do not exist: ' . implode(', ', $nonExistentStudentEmails);
                return redirect()->route('assign_student')->withError($errorMessage);
            }
        
    
    return redirect('/superadmin/course');

        
    }
    //show assign student to course form of admin dashboard
    public function assign_stud_ent(){
        $courses = Courses::all();
        return view('admindashboard.assignstudent_tocourse',compact('courses'));
    }
    //To validate and assign student into the course
    public function assign_stud_ent_tocourse(Request $request){
        $request->validate(
            [
                'batch'=>'required',
                
            ]
            );
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
                $courseid=Courses::where('course_code',$request['course'])->first();
                
        
                foreach ($studentIds as $studentId) {
                    $course_student=new Course_students;
                    $course_student->course_id=$courseid->course_id;
                    $course_student->stud_id=$studentId;
                    $course_student->year=$request['year'];
                    $course_student->sem=$request['sem'];
                    $course_student->batch=$request['batch'];
                    $course_student->save();
                }
        
                return redirect('/admin/course');
            } else {
                // Handle the case where some student emails do not exist
                $errorMessage = 'The following student emails do not exist: ' . implode(', ', $nonExistentStudentEmails);
                return redirect()->route('assign_stud_ent')->withError($errorMessage);
            }
        
    
    return redirect('/admin/course');

        
    }

    //show assign professor to course form of superadmin dashboard
    public function assign_professor(){
        $courses = Courses::all();
        return view('superadmindashboard.assignprofessor_tocourse',compact('courses'));
    }

    

     //To validate and assign professor into the course
     public function assign_professor_tocourse(Request $request){
        $request->validate(
            [
                'batch'=>'required',
                'professor_email'=>'required|email',
            ]
            );
            $requestedprofessor = $request['professor_email'];

// Check if the professor's email exists in the database
$existingemail = User::where('email', $requestedprofessor)->first();
if($existingemail){
$existingid=Professors::find($existingemail->user_id);
      if ($existingid) {
          // Assign  
          $courseid=Courses::where('course_code',$request['course'])->first();
          $course_professor=new Course_professors;
          $course_professor->course_id=$courseid->course_id;
          $course_professor->prof_id=$existingid->user_id;
          $course_professor->year=$request['year'];
          $course_professor->sem=$request['sem'];
          $course_professor->batch=$request['batch'];
          $course_professor->save();
      

      return redirect('/superadmin/course');
          
            
}
else {
    // Handle the case where the professor's email does not exist
    return redirect()->route('assign_professor')->withError('The email of the professor does not exist'); }}
    else {
        // Handle the case where the email does not exist
        return redirect()->route('assign_professor')->withError('The email does not exist in the system');
}
}
//show assign professor to course form of admin dashboard
public function assign_prof_essor(){
    $courses = Courses::all();
    return view('admindashboard.assignprofessor_tocourse',compact('courses'));
}
//To validate and assign professor into the course
public function assign_prof_essor_tocourse(Request $request){
    $request->validate(
        [
            'batch'=>'required',
            'professor_email'=>'required|email',
        ]
        );
        $requestedprofessor = $request['professor_email'];

// Check if the professor's email exists in the database
$existingemail = User::where('email', $requestedprofessor)->first();
if($existingemail){
$existingid=Professors::find($existingemail->user_id);
  if ($existingid) {
      // Assign  
      $courseid=Courses::where('course_code',$request['course'])->first();
      $course_professor=new Course_professors;
      $course_professor->course_id=$courseid->course_id;
      $course_professor->prof_id=$existingid->user_id;
      $course_professor->year=$request['year'];
      $course_professor->sem=$request['sem'];
      $course_professor->batch=$request['batch'];
      $course_professor->save();
  

  return redirect('/admin/course');
      
        
}
else {
// Handle the case where the professor's email does not exist
return redirect()->route('assign_prof_essor')->withError('The email of the professor does not exist'); }}
else {
    // Handle the case where the email does not exist
    return redirect()->route('assign_prof_essor')->withError('The email does not exist in the system');
}
}


    // Refernce code starts from here:
    // To validate and insert course into the system
    public function insert__course(Request $request){
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
