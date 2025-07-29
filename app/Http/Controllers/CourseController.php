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
use App\Models\Program_admins;

class CourseController extends Controller
{
    //show course page of superadmin dashboard
    public function showcourse(){
        $coursecount=Courses::count();
        $courses=Courses::all();
        return view('superadmindashboard.course',compact('coursecount','courses'));
    }
    //show course page of admin dashboard
    public function show_course(Request $request){
        $userObj = $request->session()->get("user");
        $userId=$userObj->user_id;
        $programid=Program_admins::where('admin_id',$userId)->first();
        $courses=Program_courses::where('program_id',$programid->program_id)->get();
        $courseIds = $courses->pluck('course_id')->all();
        $courses = Courses::whereIn('course_id', $courseIds)->get();
        $coursescount=$courses->count();
        return view('admindashboard.course',compact('coursescount','courses'));
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

    //To validate and insert course into the system (superadmin dashboard)
public function insertcourse(Request $request)
{
    try {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'credit_hour' => 'required',
            'course_description' => 'required',
        ]);

        // Check if the course code already exists
        if (Courses::where('course_code', $request['code'])->exists()) {
            return redirect()->route('addcourse')->withError('Course code already exists. Please choose a different code.');
        }

        // If not, create and save the new course
        $course = new Courses;

        // Assign course details
        $course->name = $request['name'];
        $course->course_code = $request['code'];
        $course->cr_hour = $request['credit_hour'];
        $course->course_desc = $request['course_description'];

        $course->save();

        return redirect('/superadmin/course');
    } catch (\Exception $e) {
        // Log the exception or handle it as needed
        \Log::error($e);

        // Redirect back with an error message
        return redirect()->route('addcourse')->withErrors(['error' => 'An error occurred. Please try again.']);
    }
}


        //To validate and insert course into the system(Admin dashboard)
    public function insert_course(Request $request){
        try { $request->validate(
            [
                'name'=>'required',
                'code'=>'required',
                'credit_hour'=>'required',
                'course_description'=>'required',
                
                
            ]
            );
            // Check if the course code already exists
        if (Courses::where('course_code', $request['code'])->exists()) {
            return redirect()->route('add_course')->withError('Course code already exists. Please choose a different code.');
        }
        
        // If not, create and save the new course
        $course = new Courses;
        
        // Assign course details
        $course->name = $request['name'];
        $course->course_code = $request['code'];
        $course->cr_hour = $request['credit_hour'];
        $course->course_desc = $request['course_description'];
        
        $course->save();
        
        return redirect('/admin/course');}
        catch (\Exception $e) {
            // Log the exception or handle it as needed
            \Log::error($e);
    
            // Redirect back with an error message
            return redirect()->route('add_course')->withErrors(['error' => 'An error occurred. Please try again.']);
        }
    
    
            
        }

        //show assign course to program form of admin dashboard
    public function assign_course_ad(Request $request){
        $userObj = $request->session()->get("user");
        $userId=$userObj->user_id;
        $programid=Program_admins::where('admin_id',$userId)->first();
        $program = Programs::where('program_id',$programid->program_id)->first();
        $courses = Courses::all();
        return view('admindashboard.assigncourse_toprogram',compact('program','courses'));
    }

        //show assign course to program form of superadmin dashboard
    public function assign_course(){
        $programs = Programs::all();
        $courses = Courses::all();
        return view('superadmindashboard.assigncourse_toprogram',compact('programs','courses'));
    }

    // To validate and assign course into the program
public function assign_course_toprogram_ad(Request $request)
{
    try {
        $program_course = new Program_courses;
        $courseCode = $request['course'];
        $programName = $request['program'];

        // Check if the course code and program name are valid
        $course = Courses::where('course_code', $courseCode)->first();
        $program = Programs::where('name', $programName)->first();

        if (!$course || !$program) {
            // Handle the case where the course or program is not valid
            return redirect()->route('assign_course_ad')->withError('Invalid course or program.');
        }

        // Check if the course is already assigned to the program
        $existingAssignment = Program_courses::where('program_id', $program->program_id)
            ->where('course_id', $course->course_id)
            ->first();

        if ($existingAssignment) {
            // Handle the case where the course is already assigned to the program
            return redirect()->route('assign_course_ad')->withError('The course is already assigned to the program.');
        }

        // Assign course details
        $program_course->program_id = $program->program_id;
        $program_course->course_id = $course->course_id;

        $program_course->save();

        return redirect('/admin/course');
    } catch (\Exception $e) {
        // Log the exception or handle it as needed
        \Log::error($e);

        // Redirect back with a generic error message
        return redirect()->route('assign_course_ad')->withErrors(['error' => 'An error occurred. Please try again.']);
    }
}


    // To validate and assign course into the program
public function assign_course_toprogram(Request $request)
{
    try {
        $program_course = new Program_courses;
        $courseCode = $request['course'];
        $programName = $request['program'];

        // Check if the course code and program name are valid
        $course = Courses::where('course_code', $courseCode)->first();
        $program = Programs::where('name', $programName)->first();

        if (!$course || !$program) {
            // Handle the case where the course or program is not valid
            return redirect()->route('assign_course')->withError('Invalid course or program.');
        }

        // Check if the course is already assigned to the program
        $existingAssignment = Program_courses::where('program_id', $program->program_id)
            ->where('course_id', $course->course_id)
            ->first();

        if ($existingAssignment) {
            // Handle the case where the course is already assigned to the program
            return redirect()->route('assign_course')->withError('The course is already assigned to the program.');
        }

        // Assign course details
        $program_course->program_id = $program->program_id;
        $program_course->course_id = $course->course_id;

        $program_course->save();

        return redirect('/superadmin/course');
    } catch (\Exception $e) {
        // Log the exception or handle it as needed
        \Log::error($e);

        // Redirect back with a generic error message
        return redirect()->route('assign_course')->withErrors(['error' => 'An error occurred. Please try again.']);
    }
}


        //show assign student to course form of superadmin dashboard
    public function assign_student(){
        $courses = Courses::all();
        return view('superadmindashboard.assignstudent_tocourse',compact('courses'));
    }

    // To validate and assign students into the course
public function assign_student_tocourse(Request $request)
{
    try {
        $request->validate([
            'batch' => 'required',
        ]);

        $studentEmails = $request['student_emails'];

        $studentIds = [];
        $nonExistentStudentEmails = [];
        $existingAssignmentStudentEmails = [];
        $inappropriateRoleStudentEmails = [];

        // Check if each student email exists
        foreach ($studentEmails as $studentEmail) {
            $user = User::where('email', $studentEmail)->first();

            if ($user) {
                // Check if the user has the inappropriate role for student enrollment (not 4)
                if ($user->role_id !== 4) {
                    $inappropriateRoleStudentEmails[] = $studentEmail;
                    continue; // Skip to the next iteration
                }

                $studentIds[] = $user->user_id;
                $courseId = Courses::where('course_code', $request['course'])->first();
                // Check if the student is already assigned to the course, semester, batch, and year
                $existingAssignment = Course_students::where('stud_id', $user->user_id)
                    ->where('year', $request['year'])
                    ->where('sem', $request['sem'])
                    ->where('batch', $request['batch'])
                    ->where('course_id',$courseId->course_id)
                    ->first();

                if ($existingAssignment) {
                    $existingAssignmentStudentEmails[] = $studentEmail;
                }
            } else {
                $nonExistentStudentEmails[] = $studentEmail;
            }
        }

        // Check for inappropriate role emails
        if (!empty($inappropriateRoleStudentEmails)) {
            $errorMessage = 'The following emails have inappropriate roles for student enrollment: ' . implode(', ', $inappropriateRoleStudentEmails) . '. ';
            return redirect()->route('assign_student')->withError($errorMessage);
        }

        // Check for already assigned students
        if (!empty($existingAssignmentStudentEmails)) {
            $errorMessage = 'The following students are already assigned to the course, semester, batch, and year: ' . implode(', ', $existingAssignmentStudentEmails) . '. ';
            return redirect()->route('assign_student')->withError($errorMessage);
        }

        if (empty($nonExistentStudentEmails)) {
            $courseId = Courses::where('course_code', $request['course'])->first();

            foreach ($studentIds as $studentId) {
                $courseStudent = new Course_students;
                $courseStudent->course_id = $courseId->course_id;
                $courseStudent->stud_id = $studentId;
                $courseStudent->year = $request['year'];
                $courseStudent->sem = $request['sem'];
                $courseStudent->batch = $request['batch'];
                $courseStudent->save();
            }

            return redirect('/superadmin/course');
        } else {
            // Handle the case where some student emails do not exist
            $errorMessage = 'The following student emails do not exist: ' . implode(', ', $nonExistentStudentEmails);
            return redirect()->route('assign_student')->withError($errorMessage);
        }
    } catch (\Exception $e) {
        // Log the exception or handle it as needed
        \Log::error($e);

        // Redirect back with a generic error message
        return redirect()->route('assign_student')->withErrors(['error' => 'An error occurred. Please try again.']);
    }
}

    
    //show assign student to course form of admin dashboard
    public function assign_stud_ent(Request $request){
        $userObj = $request->session()->get("user");
        $userId=$userObj->user_id;
        $programid=Program_admins::where('admin_id',$userId)->first();
        $courseIds = Program_courses::where('program_id', $programid->program_id)->pluck('course_id')->toArray();
        $courses = Courses::whereIn('course_id', $courseIds)->get();
        return view('admindashboard.assignstudent_tocourse',compact('courses'));
    }
   // To validate and assign students into the course
public function assign_stud_ent_tocourse(Request $request)
{
    try {
        $request->validate([
            'batch' => 'required',
        ]);

        $studentEmails = $request['student_emails'];

        $studentIds = [];
        $nonExistentStudentEmails = [];
        $existingAssignmentStudentEmails = [];
        $inappropriateRoleStudentEmails = [];

        // Check if each student email exists
        foreach ($studentEmails as $studentEmail) {
            $user = User::where('email', $studentEmail)->first();

            if ($user) {
                // Check if the user has the inappropriate role for student enrollment (not 4)
                if ($user->role_id !== 4) {
                    $inappropriateRoleStudentEmails[] = $studentEmail;
                    continue; // Skip to the next iteration
                }

                $studentIds[] = $user->user_id;
                $courseId = Courses::where('course_code', $request['course'])->first();
                // Check if the student is already assigned to the course, semester, batch, and year
                $existingAssignment = Course_students::where('stud_id', $user->user_id)
                    ->where('year', $request['year'])
                    ->where('sem', $request['sem'])
                    ->where('batch', $request['batch'])
                    ->where('course_id',$courseId->course_id)
                    ->first();

                if ($existingAssignment) {
                    $existingAssignmentStudentEmails[] = $studentEmail;
                }
            } else {
                $nonExistentStudentEmails[] = $studentEmail;
            }
        }

        // Check for inappropriate role emails
        if (!empty($inappropriateRoleStudentEmails)) {
            $errorMessage = 'The following emails have inappropriate roles for student enrollment: ' . implode(', ', $inappropriateRoleStudentEmails) . '. ';
            return redirect()->route('assign_stud_ent')->withError($errorMessage);
        }

        // Check for already assigned students
        if (!empty($existingAssignmentStudentEmails)) {
            $errorMessage = 'The following students are already assigned to the course, semester, batch, and year: ' . implode(', ', $existingAssignmentStudentEmails) . '. ';
            return redirect()->route('assign_stud_ent')->withError($errorMessage);
        }

        if (empty($nonExistentStudentEmails)) {
            $courseId = Courses::where('course_code', $request['course'])->first();

            foreach ($studentIds as $studentId) {
                $courseStudent = new Course_students;
                $courseStudent->course_id = $courseId->course_id;
                $courseStudent->stud_id = $studentId;
                $courseStudent->year = $request['year'];
                $courseStudent->sem = $request['sem'];
                $courseStudent->batch = $request['batch'];
                $courseStudent->save();
            }

            return redirect('/admin/course');
        } else {
            // Handle the case where some student emails do not exist
            $errorMessage = 'The following student emails do not exist: ' . implode(', ', $nonExistentStudentEmails);
            return redirect()->route('assign_stud_ent')->withError($errorMessage);
        }
    } catch (\Exception $e) {
        // Log the exception or handle it as needed
        \Log::error($e);

        // Redirect back with a generic error message
        return redirect()->route('assign_stud_ent')->withErrors(['error' => 'An error occurred. Please try again.']);
    }
}



    //show assign professor to course form of superadmin dashboard
    public function assign_professor(){
        $courses = Courses::all();
        return view('superadmindashboard.assignprofessor_tocourse',compact('courses'));
    }

    // To validate and assign professor into the course
public function assign_professor_tocourse(Request $request)
{
    try {
        $request->validate([
            'batch' => 'required',
            'professor_email' => 'required|email',
        ]);

        $requestedProfessor = $request['professor_email'];

        // Check if the professor's email exists in the database
        $existingUser = User::where('email', $requestedProfessor)->first();

        if ($existingUser) {
            // Check if the user with the given email is a professor
            $professor = Professors::where('user_id', $existingUser->user_id)->first();

            if ($professor) {
                // Check if the professor is already associated with the course, batch, semester, and year
                $courseId = Courses::where('course_code', $request['course'])->first();
                $existingAssociation = Course_professors::where('prof_id', $professor->user_id)
                    ->where('year', $request['year'])
                    ->where('sem', $request['sem'])
                    ->where('batch', $request['batch'])
                    ->where('course_id',$courseId->course_id)
                    ->first();

                if ($existingAssociation) {
                    // Handle the case where the professor is already associated with the course, batch, semester, and year
                    return redirect()->route('assign_professor')->withError('The professor is already associated with the course, batch, semester, and year');
                }

                // Assign the professor to the course
                $courseId = Courses::where('course_code', $request['course'])->first();
                $courseProfessor = new Course_professors;
                $courseProfessor->course_id = $courseId->course_id;
                $courseProfessor->prof_id = $professor->user_id;
                $courseProfessor->year = $request['year'];
                $courseProfessor->sem = $request['sem'];
                $courseProfessor->batch = $request['batch'];
                $courseProfessor->save();

                return redirect('/superadmin/course');
            } else {
                // Handle the case where the email belongs to a user, but not a professor
                return redirect()->route('assign_professor')->withError('The email belongs to a user, but not a professor');
            }
        } else {
            // Handle the case where the professor's email does not exist
            return redirect()->route('assign_professor')->withError('The email of the professor does not exist');
        }
    } catch (\Exception $e) {
        // Log the exception or handle it as needed
        \Log::error($e);

        // Redirect back with a generic error message
        return redirect()->route('assign_professor')->withErrors(['error' => 'An error occurred. Please try again.']);
    }
}

    

     

//show assign professor to course form of admin dashboard
public function assign_prof_essor(Request $request){
    $userObj = $request->session()->get("user");
        $userId=$userObj->user_id;
        $programid=Program_admins::where('admin_id',$userId)->first();
        $courseIds = Program_courses::where('program_id', $programid->program_id)->pluck('course_id')->toArray();
        $courses = Courses::whereIn('course_id', $courseIds)->get();
    return view('admindashboard.assignprofessor_tocourse',compact('courses'));
}
// To validate and assign professor into the course
//show admin dashboard
public function assign_prof_essor_tocourse(Request $request)
{
    try {
        $request->validate([
            'batch' => 'required',
            'professor_email' => 'required|email',
        ]);

        $requestedProfessor = $request['professor_email'];

        // Check if the professor's email exists in the database
        $existingUser = User::where('email', $requestedProfessor)->first();

        if ($existingUser) {
            // Check if the user with the given email is a professor
            $professor = Professors::where('user_id', $existingUser->user_id)->first();

            if ($professor) {
                // Check if the professor is already associated with the course, batch, semester, and year
                $courseId = Courses::where('course_code', $request['course'])->first();
                $existingAssociation = Course_professors::where('prof_id', $professor->user_id)
                    ->where('year', $request['year'])
                    ->where('sem', $request['sem'])
                    ->where('batch', $request['batch'])
                    ->where('course_id',$courseId->course_id)
                    ->first();

                if ($existingAssociation) {
                    // Handle the case where the professor is already associated with the course, batch, semester, and year
                    return redirect()->route('assign_prof_essor')->withError('The professor is already associated with the course, batch, semester, and year');
                }

                // Assign the professor to the course
                $courseId = Courses::where('course_code', $request['course'])->first();
                $courseProfessor = new Course_professors;
                $courseProfessor->course_id = $courseId->course_id;
                $courseProfessor->prof_id = $professor->user_id;
                $courseProfessor->year = $request['year'];
                $courseProfessor->sem = $request['sem'];
                $courseProfessor->batch = $request['batch'];
                $courseProfessor->save();

                return redirect('/admin/course');
            } else {
                // Handle the case where the email belongs to a user, but not a professor
                return redirect()->route('assign_prof_essor')->withError('The email belongs to a user, but not a professor');
            }
        } else {
            // Handle the case where the professor's email does not exist
            return redirect()->route('assign_prof_essor')->withError('The email of the professor does not exist');
        }
    } catch (\Exception $e) {
        // Log the exception or handle it as needed
        \Log::error($e);

        // Redirect back with a generic error message
        return redirect()->route('assign_prof_essor')->withErrors(['error' => 'An error occurred. Please try again.']);
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
