<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professors;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Course_students;
use App\Models\Course_plan;
use App\Models\Courses;
use App\Models\Course_professors;
use App\Models\Grades;

class ProfessorController extends Controller
{   
    //To show add professor form of admin dashboard
    public function addprofessors(){
        return view('admindashboard.addprofessors');
    }
    // To show professor dashboard
    public function showprofessors(Request $request){
        $userObj = $request->session()->get("user");
        $userId=$userObj->user_id;
        $professor=Professors::where('user_id',$userId)->first();
        return view('professordashboard.professordashboard',compact('professor'));
    }

    // To show grades page of professordashboard
    public function show_grades(Request $request){
        $userObj = $request->session()->get("user");
        $userId=$userObj->user_id;
        $professor=Professors::where('user_id',$userId)->first();
        $userObj = $request->session()->get("user");
        $userId=$userObj->user_id;
        $professor = Professors::where('user_id', $userId)->first();
$courseIds = Course_professors::where('prof_id', $userId)->pluck('course_id');

// Fetch courses from the Courses table
$courses = Courses::whereIn('course_id', $courseIds)->get();

// Fetch course_students information
$courseprofInfo = Course_professors::whereIn('course_id', $courseIds)->get();

// Combine the information into a single collection
$combinedData = $courses->map(function ($course) use ($courseprofInfo) {
    $info = $courseprofInfo->where('course_id', $course->course_id)->first();
    return [
        'course' => $course,
        'courseprofInfo' => $info,
    ];
});
        return view('professordashboard.grades',compact('professor','courses','combinedData'));
    }

    //To show the individual grades of each course
    public function show_individual_grades(Request $request, $course_id, $year, $sem, $batch)
{
    $userObj = $request->session()->get("user");
    $userId = $userObj->user_id;
    $professor = Professors::where('user_id', $userId)->first();

    // Retrieve grades
    $grades = Grades::where([
        'course_id' => $course_id,
        'year' => $year,
        'sem' => $sem,
        'batch' => $batch,
        'prof_id' => $userId
    ])->get();

    // Retrieve student information based on stud_id
    $studentInfo = [];
    foreach ($grades as $grade) {
        $user = User::find($grade->stud_id);
        $studentInfo[] = [
            'Fullname' => $user ? $user->Fullname : 'N/A',
            'email' => $user ? $user->email : 'N/A',
        ];
    }

    return view('professordashboard.individual_grade', compact('professor', 'course_id', 'year', 'sem', 'batch', 'grades', 'studentInfo'));
}

    //To show the add grades form of each course
    public function add_grades(Request $request,$course_id,$year,$sem,$batch){
        $userObj = $request->session()->get("user");
        $userId=$userObj->user_id;
        $professor=Professors::where('user_id',$userId)->first();
        $studentIds = Course_students::where([
            'course_id' => $course_id,
            'year' => $year,
            'sem' => $sem,
            'batch' => $batch,
        ])->pluck('stud_id');
        
        $studentInfos = User::whereIn('user_id', $studentIds)->get();
        return view('professordashboard.add_grades',compact('professor','studentInfos', 'course_id', 'year', 'sem', 'batch'));
    }
    //WORK REMAINING
    //To show the add grades form of each course
    public function insert_grades(Request $request,$course_id,$year,$sem,$batch){
        $request->validate(
            [
                'Firstinternal'=>'required',
                'Secondinternal'=>'required',
                'MCQ'=>'required',
                'Presentation'=>'required',
                'Assignments'=>'required',
                'Extracredits'=>'required',
                
                
            ]  );
        $userObj = $request->session()->get("user");
        $userId=$userObj->user_id;
        $professor=Professors::where('user_id',$userId)->first();
        $grades=new Grades;
        $grades->prof_id=$userId;
        $grades->course_id=$course_id;
        $grades->year=$year;
        $grades->sem=$sem;
        $grades->batch=$batch;
        $studentname=$request['studentname'];
        $studentid=User::where('Fullname',$studentname)->first();
        $grades->stud_id=$studentid->user_id;
        $grades->first_internal = $request['Firstinternal'];
        $grades->second_internal = $request['Secondinternal'];
        $grades->assignments = $request['Assignments'];
        $grades->presentation = $request['Presentation'];
        $grades->mcq = $request['MCQ'];
        $grades->extra_credit = $request['Extracredits'];
        $grades->first_internal = $request['Firstinternal'];
        $grades->save();
        return redirect('/professor/grades');
        
    }

    // To show analytics page of professordashboard
    public function show_analytics(Request $request){
        $userObj = $request->session()->get("user");
        $userId=$userObj->user_id;
        $professor=Professors::where('user_id',$userId)->first();
        return view('professordashboard.analytics',compact('professor'));
    }

    // To show todolist page of professordashboard
    public function professor_todolist(Request $request){
        $userObj = $request->session()->get("user");
        $userId=$userObj->user_id;
        $professor=Professors::where('user_id',$userId)->first();
        return view('professordashboard.todo_list',compact('professor'));
    }

    // To show student page of professordashboard
    public function showstudents_of_professor(Request $request){
        $userObj = $request->session()->get("user");
        $userId=$userObj->user_id;
        $professor = Professors::where('user_id', $userId)->first();
$courseIds = Course_professors::where('prof_id', $userId)->pluck('course_id');

// Fetch courses from the Courses table
$courses = Courses::whereIn('course_id', $courseIds)->get();

// Fetch course_students information
$courseprofInfo = Course_professors::whereIn('course_id', $courseIds)->get();

// Combine the information into a single collection
$combinedData = $courses->map(function ($course) use ($courseprofInfo) {
    $info = $courseprofInfo->where('course_id', $course->course_id)->first();
    return [
        'course' => $course,
        'courseprofInfo' => $info,
    ];
});
        return view('professordashboard.students',compact('professor','courses','combinedData'));
    }

    //To show students of each course of professor dashboard 
    public function students_in_course(Request $request,$course_id,$year,$sem,$batch){
        $userObj = $request->session()->get("user");
        $userId=$userObj->user_id;
        $professor=Professors::where('user_id',$userId)->first();
        ;
        $course=Courses::where('course_id',$course_id)->first();
        $studentIds = Course_students::where([
            'course_id' => $course_id,
            'year' => $year,
            'sem' => $sem,
            'batch' => $batch,
        ])->pluck('stud_id');
        
        $studentInfos = User::whereIn('user_id', $studentIds)->get();
        
        return view('professordashboard.course_students',compact('professor','course','studentInfos'));
    }
    //To course plan each course of professor dashboard 
    public function course_plan(Request $request, $course_id, $year, $sem, $batch)
{
    $userObj = $request->session()->get("user");
    $userId = $userObj->user_id;

    $professor = Professors::where('user_id', $userId)->first();
    $profinfo = User::where('user_id', $userId)->first();
    $course = Courses::where('course_id', $course_id)->first();

    $courseInfo = Course_plan::where([
        'course_id' => $course_id,
        'year' => $year,
        'sem' => $sem,
        'batch' => $batch,
        'prof_id' => $userId,
    ])->select('course_description', 'course_plan', 'grading_guideline')->first();

    if ($courseInfo) {
        $courseDescription = $courseInfo->course_description ?? null;
        $coursePlan = $courseInfo->course_plan ?? null;
        $gradingGuideline = $courseInfo->grading_guideline ?? null;
    } else {
        // Handle the case where no record is found
        $courseDescription = $coursePlan = $gradingGuideline = null;
    }

    return view('professordashboard.individual_course', compact('professor', 'course', 'profinfo', 'courseDescription', 'coursePlan', 'gradingGuideline','course_id','year','sem','batch'));
}

//To show the add recources of course of each course of professor dashboard 
public function course_add_resources(Request $request, $course_id, $year, $sem, $batch){
    $userObj = $request->session()->get("user");
    $userId = $userObj->user_id;
    $professor = Professors::where('user_id', $userId)->first();
    $profinfo = User::where('user_id', $userId)->first();
    return view('professordashboard.add_resources',compact('profinfo','professor','course_id','year','sem','batch'));

}
public function course_insert_resources(Request $request, $course_id, $year, $sem, $batch){
    $request->validate(
        [
            'courseDescription'=>'required',
            'courseplan'=>'required',
            'gradeGuidelines'=>'required',
            
            
        ]  );
        $userObj = $request->session()->get("user");
        $userId = $userObj->user_id;
        $course_plan=new Course_plan;
        $course_plan->prof_id= $userId;
        $course_plan->course_id= $course_id;
        $course_plan->year= $year;
        $course_plan->sem= $sem;
        $course_plan->batch= $batch;
        $course_plan->course_description = $request['courseDescription'];
        $course_plan->grading_guideline = $request['gradeGuidelines'];
        $name =$request->file('courseplan')->getClientOriginalName();
        $request->file('courseplan')->storeAs('public/images/',$name);
        $course_plan->course_plan =$name;
        
        $course_plan->save();
        return redirect('/professor/courses');

    

    

}

    // To show course page of professordashboard
    public function showcourses_of_professor(Request $request){
        $userObj = $request->session()->get("user");
        $userId=$userObj->user_id;
        $professor = Professors::where('user_id', $userId)->first();
$courseIds = Course_professors::where('prof_id', $userId)->pluck('course_id');

// Fetch courses from the Courses table
$courses = Courses::whereIn('course_id', $courseIds)->get();

// Fetch course_students information
$courseprofInfo = Course_professors::whereIn('course_id', $courseIds)->get();

// Combine the information into a single collection
$combinedData = $courses->map(function ($course) use ($courseprofInfo) {
    $info = $courseprofInfo->where('course_id', $course->course_id)->first();
    return [
        'course' => $course,
        'courseprofInfo' => $info,
    ];
});
        return view('professordashboard.courses',compact('professor','courses','combinedData'));
    }

    //To validate and insert students into the system
    public function insertprofessors(Request $request){
        $request->validate(
            [
                'first_name'=>'required',
                'last_name'=>'required',
                'permanent_address'=>'required',
                'temporary_address'=>'required',
                'email'=>'required|email',
                'password'=>'required',
                'phone_number'=>'required',
                
            ]
            );
            $user=new User;
            $user->Fullname = $request['first_name'] . ' ' . $request['last_name'];
            
            $requestedEmail = $request['email'];
            
            // Check if the email already exists in the database
            $existingEmail = User::where('email', $requestedEmail)->first();
            
            if ($existingEmail) {
                // Email already taken, show a message or take appropriate action
                return redirect()->route('professor')->withError('This email has already been taken');
                
            } else {
                // Assign the email to the user
                $user->email = $requestedEmail;

            $user->password=\Hash::make($request['password']);
            $user->role_id=3;
            $user->phone_number=$request['phone_number'];
            $user->save();
            $professors=new Professors;
            $professors->Firstname=$request['first_name'];
            $professors->Lastname=$request['last_name'];
            $professors->permanent_address=$request['permanent_address'];
            $professors->temporary_address=$request['temporary_address'];
            $lastInsertedUserId = $user->getKey();
            $professors->user_id=$lastInsertedUserId;
            $professors->save();
            return redirect('/admin');
       
        }}

        //To show add professor form of superadmin dashboard
    public function add_professors(){
        return view('superadmindashboard.addprofessors');
    }

    //To validate and insert students into the system
    public function insert_professors(Request $request){
        $request->validate(
            [
                'first_name'=>'required',
                'last_name'=>'required',
                'permanent_address'=>'required',
                'temporary_address'=>'required',
                'email'=>'required|email',
                'password'=>'required',
                'phone_number'=>'required',
                
            ]
            );
            $user=new User;
            $user->Fullname = $request['first_name'] . ' ' . $request['last_name'];
            
            $requestedEmail = $request['email'];
            
            // Check if the email already exists in the database
            $existingEmail = User::where('email', $requestedEmail)->first();
            
            if ($existingEmail) {
                // Email already taken, show a message or take appropriate action
                return redirect()->route('add_professor')->withError('This email has already been taken');
                
            } else {
                // Assign the email to the user
                $user->email = $requestedEmail;

            $user->password=\Hash::make($request['password']);
            $user->role_id=3;
            $user->phone_number=$request['phone_number'];
            $user->save();
            $professors=new Professors;
            $professors->Firstname=$request['first_name'];
            $professors->Lastname=$request['last_name'];
            $professors->permanent_address=$request['permanent_address'];
            $professors->temporary_address=$request['temporary_address'];
            $lastInsertedUserId = $user->getKey();
            $professors->user_id=$lastInsertedUserId;
            $professors->save();
            return redirect('/superadmin');
       
        }}
}
