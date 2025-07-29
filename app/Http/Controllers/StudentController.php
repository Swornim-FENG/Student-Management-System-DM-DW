<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Course_students;
use App\Models\Courses;
use App\Models\Course_professors;
use App\Models\Grades;
use App\Models\Course_plan;
use App\Models\Superadmin_notice;
use App\Models\Admin_notice;

class StudentController extends Controller
{    

    //To show students dashboard 
    public function showstudent(Request $request){
        $userObj = $request->session()->get("user");
        $userId=$userObj->user_id;
        $student=Students::where('user_id',$userId)->first();
        return view('studentdashboard.studentdashboard',compact('student'));
    }

    public function show_individual_grades(Request $request, $course_id, $year, $sem, $batch)
    {
        $userObj = $request->session()->get("user");
        $userId = $userObj->user_id;
        $student = Students::where('user_id', $userId)->first();
        $grades = Grades::where([
            'course_id' => $course_id,
            'year' => $year,
            'sem' => $sem,
            'batch' => $batch,
            'stud_id' => $userId
        ])->first();
    
        $profinfo = null;
        if ($grades && $grades->prof_id) {
            $profinfo = User::find($grades->prof_id);
        }
    
        return view('studentdashboard.individual_grades', compact('student', 'grades', 'profinfo'));
    }
    
    

    public function students_grades(Request $request)
    {
        $userObj = $request->session()->get("user");
        $userId = $userObj->user_id;
        $student = Students::where('user_id', $userId)->first();
    
        // Step 1: Retrieve course_ids
        $courseIds = Course_students::where('stud_id', $userId)->orderBy('year')
        ->orderBy('sem')->pluck('course_id');
    
        // Fetch courses from the Courses table
        $courses = Courses::whereIn('course_id', $courseIds)->get();
    
        // Initialize an empty array to store the combined data
        $combinedData = [];
    
        // Iterate over each course_id
        foreach ($courseIds as $courseId) {
            // Step 2: Fetch the course information
            $course = Courses::where('course_id', $courseId)->first();
    
            // Step 3: Fetch course_students information for the specific course and user
            $courseStudentInfo = Course_students::where('course_id', $courseId)
                ->where('stud_id', $userId)
                ->first();
    
            // Combine the information into a single array and add it to the result
            $combinedData[] = [
                'course' => $course,
                'courseStudentInfo' => $courseStudentInfo,
            ];
        }
    
        return view('studentdashboard.grades', compact('student', 'courses', 'combinedData'));
    }
    


    //To show courses page of student dashboard 
    public function students_courses(Request $request){
        $userObj = $request->session()->get("user");
        $userId = $userObj->user_id;
        $student = Students::where('user_id', $userId)->first();
    
        // Step 1: Retrieve course_ids
        $courseIds = Course_students::where('stud_id', $userId)->orderBy('year')
        ->orderBy('sem')->pluck('course_id');
    
        // Fetch courses from the Courses table
        $courses = Courses::whereIn('course_id', $courseIds)->get();
    
        // Initialize an empty array to store the combined data
        $combinedData = [];
    
        // Iterate over each course_id
        foreach ($courseIds as $courseId) {
            // Step 2: Fetch the course information
            $course = Courses::where('course_id', $courseId)->first();
    
            // Step 3: Fetch course_students information for the specific course and user
            $courseStudentInfo = Course_students::where('course_id', $courseId)
                ->where('stud_id', $userId)
                ->first();
    
            // Combine the information into a single array and add it to the result
            $combinedData[] = [
                'course' => $course,
                'courseStudentInfo' => $courseStudentInfo,
            ];
        }
    
        return view('studentdashboard.courses', compact('student', 'courses', 'combinedData'));
    }

     //To show individual course page of student dashboard 
     public function students_indcourse(Request $request, $course_id, $year, $sem, $batch)
     {
         $userObj = $request->session()->get("user");
         $userId = $userObj->user_id;
         $student = Students::where('user_id', $userId)->first();
         $course = Courses::where('course_id', $course_id)->first();
         $professor = Course_professors::where([
             'course_id' => $course_id,
             'year' => $year,
             'sem' => $sem,
             'batch' => $batch,
         ])->first();
     
         $courseDescription = $coursePlan = $gradingGuideline = null; // Initialize the variables
     
         if ($professor && $professor->prof_id !== null) {
             $profinfo = User::find($professor->prof_id);
             $courseInfo = Course_plan::where([
                 'course_id' => $course_id,
                 'year' => $year,
                 'sem' => $sem,
                 'batch' => $batch,
                 'prof_id' => $professor->prof_id,
             ])->select('course_description', 'course_plan', 'grading_guideline')->first();
     
             if ($courseInfo) {
                 $courseDescription = $courseInfo->course_description ?? null;
                 $coursePlan = $courseInfo->course_plan ?? null;
                 $gradingGuideline = $courseInfo->grading_guideline ?? null;
             }
         } else {
             $profinfo = null;
         }
     
         return view('studentdashboard.individualcourse', compact('student', 'course', 'profinfo', 'courseDescription', 'coursePlan', 'gradingGuideline'));
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
    
    // To validate and insert students into the system
public function insertstudents(Request $request)
{
    try {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'permanent_address' => 'required',
            'temporary_address' => 'required',
            'email' => 'required|email',
            'registration_no' => 'required',
            'password' => 'required',
            'date_of_birth' => 'required',
            'phone_number' => 'required',
            'mother_name' => 'required',
            'father_name' => 'required',
        ]);

        $user = new User;
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

            $user->password = \Hash::make($request['password']);
            $user->role_id = 4;
            $user->phone_number = $request['phone_number'];

            $student = new Students;
            $student->Firstname = $request['first_name'];
            $student->Lastname = $request['last_name'];

            $requestedreg = $request['registration_no'];
            // Check if the Registration number already exists in the database
            $existingreg = Students::where('registration_no', $requestedreg)->first();

            if ($existingreg) {
                // Registration number already taken, show a message or take appropriate action
                return redirect()->route('student')->withError('This registration number has already been taken');
            } else {
                // Assign the Registration number to the user  
                $student->registration_no = $requestedreg;
                $user->save();
                $student->permanent_address = $request['permanent_address'];
                $student->temporary_address = $request['temporary_address'];
                $student->Mother_name = $request['mother_name'];
                $student->Father_name = $request['father_name'];
                $student->dob = $request['date_of_birth'];
                $lastInsertedUserId = $user->getKey();
                $student->user_id = $lastInsertedUserId;
                $student->save();
                return redirect('/admin');
            }
        }
    } catch (\Exception $e) {
        // Log the exception or handle it as needed
        \Log::error($e);

        // Redirect back with an error message
        return redirect()->route('student')->withErrors(['error' => 'An error occurred. Please try again.']);
    }
}


        //To show add students form of superadmin dashboard 
    public function add_students(){
        return view('superadmindashboard.addstudents');
    }
    
    //To validate and insert students into the system
public function insert_students(Request $request)
{
    try {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'permanent_address' => 'required',
            'temporary_address' => 'required',
            'email' => 'required|email',
            'registration_no' => 'required',
            'password' => 'required',
            'date_of_birth' => 'required',
            'phone_number' => 'required',
            'mother_name' => 'required',
            'father_name' => 'required',
        ]);

        $user = new User;
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

            $user->password = \Hash::make($request['password']);
            $user->role_id = 4;
            $user->phone_number = $request['phone_number'];

            $student = new Students;
            $student->Firstname = $request['first_name'];
            $student->Lastname = $request['last_name'];

            $requestedreg = $request['registration_no'];

            // Check if the Registration number already exists in the database
            $existingreg = Students::where('registration_no', $requestedreg)->first();

            if ($existingreg) {
                // Registration number already taken, show a message or take appropriate action
                return redirect()->route('add_student')->withError('This registration number has already been taken');
            } else {
                // Assign the Registration number to the user
                $student->registration_no = $requestedreg;
                $user->save();
                $student->permanent_address = $request['permanent_address'];
                $student->temporary_address = $request['temporary_address'];
                $student->Mother_name = $request['mother_name'];
                $student->Father_name = $request['father_name'];
                $student->dob = $request['date_of_birth'];
                $lastInsertedUserId = $user->getKey();
                $student->user_id = $lastInsertedUserId;
                $student->save();
                return redirect('/superadmin');
            }
        }
    } catch (\Exception $e) {
        // Log the exception or handle it as needed
        // For example, log the exception details:
        \Log::error($e);

        // Redirect back with an error message
        return redirect()->route('add_student')->withError('An error occurred. Please try again.');
    }
}
public function fee(Request $request){
    $userObj = $request->session()->get("user");
    $userId = $userObj->user_id;
    $student = Students::where('user_id', $userId)->first();   
    return view('studentdashboard.fee',compact('student'));
}

public function notice(Request $request){
    $notices = Superadmin_notice::all();
$userObj = $request->session()->get("user");
$userId = $userObj->user_id;

// Get the program ID of the student
$programId = Students::where('user_id', $userId)->first()->program_id;

// Get the admin notices for the student's program
$admin_notices = Admin_notice::where('program_id', $programId)->get();

// Combine all notices into a single collection
$all_notices = $notices->concat($admin_notices);

// Group notices by date
$grouped_notices = $all_notices->groupBy(function ($item) {
    return $item->created_at->format('Y-m-d'); // Group by date
});

$userObj = $request->session()->get("user");
$userId = $userObj->user_id;
$student = Students::where('user_id', $userId)->first();

return view('studentdashboard.notice', compact('student', 'grouped_notices'));
}

public function student_attendance(Request $request){
    $userObj = $request->session()->get("user");
    $userId=$userObj->user_id;
    $student=Students::where('user_id',$userId)->first();
    return view('studentdashboard.attendance',compact('student'));
}
//show admin dashboard

public function student_individual_attendance(Request $request){
    $userObj = $request->session()->get("user");
    $userId=$userObj->user_id;
    $student=Students::where('user_id',$userId)->first();
    return view('studentdashboard.individualattendance',compact('student'));
}

}
