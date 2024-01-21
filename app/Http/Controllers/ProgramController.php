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
use Exception;

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
public function insertprogram(Request $request)
{
    try {
        $request->validate([
            'name' => 'required',
            'department' => 'required',
        ]);

        $program = new Programs;
        $requestedName = $request['name'];

        // Check if the name already exists in the database
        $existingName = Programs::where('name', $requestedName)->first();

        if ($existingName) {
            // Name already taken, show a message or take appropriate action
            return redirect()->route('addprogram')->withError('This name has already been taken');
        } else {
            // Assign the name
            $program->name = $requestedName;
            $departmentId = Departments::where('name', $request['department'])->first();
            $program->dep_id = $departmentId->dep_id;
            $program->save();
            return redirect('/superadmin/program');
        }
    } catch (\Exception $e) {
        // Log the exception or handle it as needed
        \Log::error($e);

        // Redirect back with an error message
        return redirect()->route('addprogram')->withErrors(['error' => 'An error occurred. Please try again.']);
    }
}


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

    // To validate and insert students into the program
public function insert_student_toprogram(Request $request)
{
    try {
        $studentEmails = $request['student_emails'];

        $studentIds = [];
        $nonExistentStudentEmails = [];
        $alreadyEnrolledStudentEmails = [];
        $otherRolesStudentEmails = [];

        $errorMessage = ''; // Initialize the error message

        // Check if each student email exists
        foreach ($studentEmails as $studentEmail) {
            $user = User::where('email', $studentEmail)->first();

            if ($user) {
                // Check if the user has the role appropriate for student enrollment (role_id 4)
                if ($user->role_id !== 4) {
                    $otherRolesStudentEmails[] = $studentEmail;
                    continue; // Skip to the next iteration
                }

                $studentIds[] = $user->user_id;

                // Check if the student is already enrolled in a program
                $existingEnrollment = Students::where('user_id', $user->user_id)
                    ->whereNotNull('program_id')
                    ->first();

                if ($existingEnrollment) {
                    $alreadyEnrolledStudentEmails[] = $studentEmail;
                }
            } else {
                $nonExistentStudentEmails[] = $studentEmail;
            }
        }

        // Check for other roles emails
        if (!empty($otherRolesStudentEmails)) {
            $errorMessage .= 'The following emails belong to users with roles other than students: ' . implode(', ', $otherRolesStudentEmails) . ".\n";
        }

        if (empty($nonExistentStudentEmails) && empty($alreadyEnrolledStudentEmails) && empty($otherRolesStudentEmails)) {
            $program = Programs::where('name', $request['program'])->first();

            foreach ($studentIds as $studentId) {
                $student = Students::find($studentId);
                $student->program_id = $program->program_id;
                $student->save();
            }

            return redirect('/superadmin');
        } else {
            // Handle the case where some student emails do not exist, are already enrolled, or have other roles
            if (!empty($nonExistentStudentEmails)) {
                $errorMessage .= 'The following student emails do not exist: ' . implode(', ', $nonExistentStudentEmails) . ".\n";
            }

            if (!empty($alreadyEnrolledStudentEmails)) {
                $errorMessage .= 'The following students are already enrolled in a program: ' . implode(', ', $alreadyEnrolledStudentEmails) . ".\n";
            }

            return redirect()->route('add_student_toprogram')->withError($errorMessage);
        }
    } catch (\Exception $e) {
        // Log the exception or handle it as needed
        \Log::error($e);

        // Redirect back with a generic error message
        return redirect()->route('add_student_toprogram')->withErrors(['error' => 'An error occurred. Please try again.']);
    }
}


        

      // To validate and insert students into the program
public function insert_stud_ent_toprogram(Request $request)
{
    try {
        $studentEmails = $request['student_emails'];

        $studentIds = [];
        $nonExistentStudentEmails = [];
        $alreadyEnrolledStudentEmails = [];
        $otherRolesStudentEmails = [];

        $errorMessage = ''; // Initialize the error message

        // Check if each student email exists
        foreach ($studentEmails as $studentEmail) {
            $user = User::where('email', $studentEmail)->first();

            if ($user) {
                // Check if the user has the role appropriate for student enrollment (role_id 4)
                if ($user->role_id !== 4) {
                    $otherRolesStudentEmails[] = $studentEmail;
                    continue; // Skip to the next iteration
                }

                $studentIds[] = $user->user_id;

                // Check if the student is already enrolled in a program
                $existingEnrollment = Students::where('user_id', $user->user_id)
                    ->whereNotNull('program_id')
                    ->first();

                if ($existingEnrollment) {
                    $alreadyEnrolledStudentEmails[] = $studentEmail;
                }
            } else {
                $nonExistentStudentEmails[] = $studentEmail;
            }
        }

        // Check for other roles emails
        if (!empty($otherRolesStudentEmails)) {
            $errorMessage .= 'The following emails belong to users with roles other than students: ' . implode(', ', $otherRolesStudentEmails) . ".\n";
        }

        if (empty($nonExistentStudentEmails) && empty($alreadyEnrolledStudentEmails) && empty($otherRolesStudentEmails)) {
            $program = Programs::where('name', $request['program'])->first();

            foreach ($studentIds as $studentId) {
                $student = Students::find($studentId);
                $student->program_id = $program->program_id;
                $student->save();
            }

            return redirect('/admin');
        } else {
            // Handle the case where some student emails do not exist, are already enrolled, or have other roles
            if (!empty($nonExistentStudentEmails)) {
                $errorMessage .= 'The following student emails do not exist: ' . implode(', ', $nonExistentStudentEmails) . ".\n";
            }

            if (!empty($alreadyEnrolledStudentEmails)) {
                $errorMessage .= 'The following students are already enrolled in a program: ' . implode(', ', $alreadyEnrolledStudentEmails) . ".\n";
            }

            return redirect()->route('add_stud_ent_toprogram')->withError($errorMessage);
        }
    } catch (\Exception $e) {
        // Log the exception or handle it as needed
        \Log::error($e);

        // Redirect back with a generic error message
        return redirect()->route('add_stud_ent_toprogram')->withErrors(['error' => 'An error occurred. Please try again.']);
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

   // To validate and insert professor into program 
public function insert_professor_toprogram(Request $request)
{
    try {
        $request->validate([
            'professor_email' => 'required|email',
        ]);

        $program_professor = new Program_professors;
        $requestedProfessor = $request['professor_email'];

        // Check if the professor's email exists in the database
        $existingUser = User::where('email', $requestedProfessor)->first();

        if ($existingUser) {
            // Check if the user with the given email is a professor
            $professor = Professors::where('user_id', $existingUser->user_id)->first();

            if ($professor) {
                // Check if the professor is already associated with the program
                $programname = Programs::where('name', $request['program'])->first();
                $existingAssociation = Program_professors::where('prof_id', $professor->user_id)
                    ->where('program_id', $programname->program_id)
                    ->first();

                if ($existingAssociation) {
                    // Handle the case where the professor is already associated with the program
                    return redirect()->route('add_professor_toprogram')->withError('The professor is already associated with the program.');
                }

                // Assign the professor to the program
                $programId = Programs::where('name', $request['program'])->first();
                $program_professor->program_id = $programId->program_id;
                $program_professor->prof_id = $professor->user_id;
                $program_professor->save();

                return redirect('/superadmin');
            } else {
                // Handle the case where the email belongs to a user, but not a professor
                return redirect()->route('add_professor_toprogram')->withError('The email belongs to a user, but not a professor');
            }
        } else {
            // Handle the case where the professor's email does not exist
            return redirect()->route('add_professor_toprogram')->withError('The email of the professor does not exist');
        }
    } catch (\Exception $e) {
        // Log the exception or handle it as needed
        \Log::error($e);

        // Redirect back with a generic error message
        return redirect()->route('add_professor_toprogram')->withErrors(['error' => 'An error occurred. Please try again.']);
    }
}


       //To validate and insert professor into program
public function insert_prof_essor_toprogram(Request $request)
{
    $request->validate(
        [
            'professor_email' => 'required|email',
        ]
    );

    $userObj = $request->session()->get("user");
    $userId = $userObj->user_id;
    $programadmin = Program_admins::where('admin_id', $userId)->first();
    $programId = $programadmin->program_id;
    $program_professor = new Program_professors;
    $requestedprofessor = $request['professor_email'];

    // Check if the professor's email exists in the database
    $existingUser = User::where('email', $requestedprofessor)->first();

    if ($existingUser) {
        // Check if the user with the given email is a professor
        $professor = Professors::where('user_id', $existingUser->user_id)->first();

        if ($professor) {
            // Check if the professor is already associated with the program
            $existingAssociation = Program_professors::where('prof_id', $professor->user_id)
                ->where('program_id', $programId)
                ->first();

            if ($existingAssociation) {
                // Handle the case where the professor is already associated with the program
                return redirect()->route('add_prof_essor_toprogram')->withError('The professor is already in the program');
            }

            // Assign the program and professor
            $program_professor->program_id = $programId;
            $program_professor->prof_id = $professor->user_id;
            $program_professor->save();

            return redirect('/admin');
        } else {
            // Handle the case where the email belongs to a user, but not a professor
            return redirect()->route('add_prof_essor_toprogram')->withError('The email belongs to a user, but not a professor');
        }
    } else {
        // Handle the case where the professor's email does not exist
        return redirect()->route('add_prof_essor_toprogram')->withError('The email of the professor does not exist');
    }
}


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
