<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admins;
use App\Models\User;
use App\Models\Program_admins;
use Illuminate\Support\Facades\Auth;
use App\Models\Programs;
use App\Models\Students;
use App\Models\Program_professors;
use App\Models\Program_courses;
use App\Models\Course_students;
use App\Models\Course_professors;
use App\Models\Superadmin_notice;
use App\Models\Admin_notice;

class AdminController extends Controller
{
    //show admin dashboard
    //show admin dashboard
    public function showadmin(Request $request){
        $userObj = $request->session()->get("user");
        $userId=$userObj->user_id;
        $programid=Program_admins::where('admin_id',$userId)->first();
        $program =Programs::where('program_id',$programid->program_id)->first();
        $students=Students::where('program_id',$programid->program_id);
        $studentscount=$students->count();
        $professors=Program_professors::where('program_id',$programid->program_id);
        $professorscount=$professors->count();
        $courses=Program_courses::where('program_id',$programid->program_id);
        $coursescount=$courses->count();
        $recentUsers = User::orderBy('created_at', 'desc')->take(4)->get();
        return view('admindashboard.admindashboard',compact('program','studentscount','professorscount','coursescount','recentUsers'));
    }
    //show add admin form
    public function showaddadmin(){
        return view('superadmindashboard.addadmin');
    }
    //show student page of admindashboard
    public function showstudent(Request $request){
        $userObj = $request->session()->get("user");
        $userId=$userObj->user_id;
        $programid=Program_admins::where('admin_id',$userId)->first();
        $students=Students::where('program_id',$programid->program_id);
        $studentscount=$students->count();
        $program=Programs::where('program_id',$programid->program_id)->first();
        // Step 1: Retrieve student IDs with the given program ID
   $studentIds = Students::where('program_id', $programid->program_id)->pluck('user_id');

   // Step 2: Retrieve student details (name and email) from the user table based on the student IDs
   $students = User::whereIn('user_id', $studentIds)->get(['Fullname', 'email','phone_number']);
        return view('admindashboard.studentpage', ['students' => $students],compact('program','studentscount'));
    }

    //show professor page of admindashboard
    public function showprofessor(Request $request){
        $userObj = $request->session()->get("user");
        $userId=$userObj->user_id;
        $programid=Program_admins::where('admin_id',$userId)->first();
        $professors=Program_professors::where('program_id',$programid->program_id);
        $professorscount=$professors->count();
        $program=Programs::where('program_id',$programid->program_id)->first();
        // Step 1: Retrieve student IDs with the given program ID
    $professorIds = Program_professors::where('program_id', $programid->program_id)->pluck('prof_id');

    // Step 2: Retrieve student details (name and email) from the user table based on the student IDs
    $professors = User::whereIn('user_id', $professorIds)->get(['Fullname', 'email','phone_number']);
        return view('admindashboard.professorpage', ['professors' => $professors],compact('program','professorscount'));
    }

    

    public function insertadmin(Request $request)
{
    try {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'per_address' => 'required',
            'tem_address' => 'required',
            'phone_number' => 'required|digits:10',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = new User;
        $user->Fullname = $request['first_name'] . ' ' . $request['last_name'];

        $requestedEmail = $request['email'];

        // Check if the email already exists in the database
        $existingEmail = User::where('email', $requestedEmail)->first();

        if ($existingEmail) {
            // Email already taken, show a message or take appropriate action
            return redirect()->route('addadmin')->withError('This email has already been taken');
        } else {
            // Assign the email to the user
            $user->email = $requestedEmail;
            $user->password = \Hash::make($request['password']);
            $user->role_id = 2;
            $user->phone_number = $request['phone_number'];
            $user->save();

            $admins = new Admins;
            $admins->Firstname = $request['first_name'];
            $admins->Lastname = $request['last_name'];
            $admins->permanent_address = $request['per_address'];
            $admins->temporary_address = $request['tem_address'];
            $lastInsertedUserId = $user->getKey();
            $admins->user_id = $lastInsertedUserId;
            $admins->save();

            return redirect('/superadmin/admin');
        }
    } catch (\Exception $e) {
        // Log the exception or handle it as needed
        // For example, log the exception details:
        \Log::error($e);

        // Redirect back with an error message
        return redirect()->route('addadmin')->withError('An error occurred. Please try again.');
    }
}

public function notice(Request $request)
{
    $notices = Superadmin_notice::all();
    $userObj = $request->session()->get("user");
    $userId = $userObj->user_id;
    $programid = Program_admins::where('admin_id', $userId)->first();
    $admin_notices = Admin_notice::where('program_id', $programid->program_id)->get();

    // Combine all notices into a single collection
    $all_notices = $notices->concat($admin_notices);

    // Group notices by date
    $grouped_notices = $all_notices->groupBy(function ($item) {
        return $item->created_at->format('Y-m-d'); // Group by date
    });

    return view('admindashboard.notice', compact('grouped_notices'));
}

public function show_add_notice(){
    
    return view('admindashboard.addnotice');
}

public function fee(){
        
    return view('admindashboard.fee');
}

public function add_notice(Request $request){
    $request->validate(
        [
            'noticeHeading'=>'required',
            'noticeDescription'=>'required',
            'fileUpload'=>'required'
            
        ]
        );
        $admin_notice=new Admin_notice;
        $userObj = $request->session()->get("user");
        $userId=$userObj->user_id;
        $admin_notice->user_id=$userId;
        $programid=Program_admins::where('admin_id',$userId)->first();
        $admin_notice->program_id=$programid->program_id;
        $admin_notice->notice_description = $request['noticeDescription'];
        $admin_notice->notice_heading = $request['noticeHeading'];
        $name =$request->file('fileUpload')->getClientOriginalName();
        $request->file('fileUpload')->storeAs('public/images/',$name);
        $admin_notice->notice_file =$name;
        $admin_notice->save();
        return redirect('/admin/notice');

    
    
}

}
