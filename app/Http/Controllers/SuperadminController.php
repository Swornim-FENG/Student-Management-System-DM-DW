<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admins;
use App\Models\User;
use App\Models\Program_admins;
use Illuminate\Support\Facades\Auth;
use App\Models\Programs;
use App\Models\Courses;
use App\Models\Departments;
use App\Models\Course_users;
use App\Models\Program_courses;
use App\Models\Course_students;
use App\Models\Course_professors;
use App\Models\Professors;
use App\Models\Schools;
use App\Models\Students;
use App\Models\Program_students;
use App\Models\Program_professors;
use App\Models\Superadmin_notice;

class SuperadminController extends Controller
{
    //show admin dashboard
    public function showsuperadmin(){
        $studentsCount = Students::count();
        $professorsCount = Professors::count();
        $schoolsCount = Schools::count();
        $coursesCount = Courses::count();
        $recentUsers = User::orderBy('created_at', 'desc')->take(4)->get();
        return view('superadmindashboard.superadmindashboard',compact('studentsCount','professorsCount','schoolsCount','coursesCount','recentUsers'));
    }
    //show adminpage of superadmindashboard
    public function showadmin(){
        $adminsCount = Admins::count();

        // Step 1: Retrieve all user_ids from admin table
    $userIds = Admins::pluck('user_id')->toArray();

    // Check if there are no user_ids
    if (empty($userIds)) {
        // Handle the case where there are no user_ids
        return view('superadmindashboard.adminpage', ['adminsCount' => $adminsCount, 'noUsers' => true]);
    }

    // Step 2: Retrieve Fullname, department, and email for each user
    $users = User::whereIn('user_id', $userIds)->get();

    // Step 3: Retrieve program_ids from program_admins table based on user_ids
    $programAdmins = Program_admins::whereIn('admin_id', $userIds)->get();
    $programIds = $programAdmins->pluck('program_id');

    // Step 4: Retrieve program names from program table based on program_ids
    $programs = Programs::whereIn('program_id', $programIds)->get();
    $programNames = $programs->pluck('name');

    return view('superadmindashboard.adminpage', ['adminsCount' => $adminsCount, 'users' => $users, 'programNames' => $programNames]);
    }

    //show  schoolpage of superadmindashboard
    public function showschool(){
        $schoolsCount = Schools::count();
        $schools=Schools::all();
        return view('superadmindashboard.schoolpage',compact('schoolsCount','schools'));
    }

    //show  departmentpage of superadmindashboard
    public function showdepartment(){
        $departmentCount = Departments::count();

    // Step 1: Retrieve all departments with school_id
    $departments = Departments::all();

    // Step 2: Retrieve corresponding school names based on school_id
    $schoolIds = $departments->pluck('school_id')->toArray();
    $schools = Schools::whereIn('school_id', $schoolIds)->get();

    return view('superadmindashboard.departmentpage', compact('departmentCount'), ['departments' => $departments, 'schools' => $schools]);
    }

    //show  studentpage of superadmindashboard
    public function showstudent(){
        $studentsCount=Students::count();
        $programs=Programs::all();
        return view('superadmindashboard.studentpage',compact('studentsCount','programs'));
    }

    //show  students in program of studentpage of superadmindashboard
    public function showstudent_in_program($program_id){
        $program=Programs::where('program_id',$program_id)->first();
         // Step 1: Retrieve student IDs with the given program ID
    $studentIds = Students::where('program_id', $program_id)->pluck('user_id');

    // Step 2: Retrieve student details (name and email) from the user table based on the student IDs
    $students = User::whereIn('user_id', $studentIds)->get(['Fullname', 'email','phone_number']);

    return view('superadmindashboard.students_in_program', ['students' => $students],compact('program'));
    }

    //show  professorpage of superadmindashboard
    public function showprofessor(){
        $professorsCount=Professors::count();
        $programs=Programs::all();
        return view('superadmindashboard.professorpage',compact('professorsCount','programs'));
    }

    //show  professors in program of professorpage of superadmindashboard
    public function showprofessor_in_program($program_id){
        $program=Programs::where('program_id',$program_id)->first();
         // Step 1: Retrieve student IDs with the given program ID
    $professorIds = Program_professors::where('program_id', $program_id)->pluck('prof_id');

    // Step 2: Retrieve student details (name and email) from the user table based on the student IDs
    $professors = User::whereIn('user_id', $professorIds)->get(['Fullname', 'email','phone_number']);
        return view('superadmindashboard.professors_in_program' , ['professors' => $professors],compact('program'));
    }

    public function notice(){
        $notices = Superadmin_notice::all();
        return view('superadmindashboard.notice', compact('notices'));
    }

    public function show_add_notice(){
        return view('superadmindashboard.addnotice');
    }

    public function add_notice(Request $request){
        $request->validate(
            [
                'noticeHeading'=>'required',
                'noticeDescription'=>'required',
                'fileUpload'=>'required'
                
            ]
            );
            $superadmin_notice=new Superadmin_notice;
            $superadmin_notice->notice_description = $request['noticeDescription'];
            $superadmin_notice->notice_heading = $request['noticeHeading'];
            $name =$request->file('fileUpload')->getClientOriginalName();
            $request->file('fileUpload')->storeAs('public/images/',$name);
            $superadmin_notice->notice_file =$name;
            $superadmin_notice->save();
            return redirect('/superadmin/notice');

        
        
    }
    
}
