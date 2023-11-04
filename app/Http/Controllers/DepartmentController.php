<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schools;
use App\Models\Departments;
use App\Models\Department_users;
use App\Models\User;
use App\Models\Admins;
use App\Models\Students;
use App\Models\Professors;

class DepartmentController extends Controller
{
    //show add department form
    public function showadddepartment(){
        $schools = Schools::all();
        return view('superadmindashboard.adddepartment',compact('schools'));
    }

    //To validate and insert department into the system
    public function insertdepartment(Request $request){
        $request->validate(
            [
                'name'=>'required',
                'school'=>'required',
                
                
            ]
            );
            $Department=new Departments;
            
            $requestedname = $request['name'];
            
            // Check if the name already exists in the database
            $existingname = Departments::where('name', $requestedname)->first();
            
            if ($existingname) {
                // Name already taken, show a message or take appropriate action
                return redirect()->route('adddepartment')->withError('This name has already been taken');
                
            } else {
                // Assign the name
            $Department->name=$requestedname;
            $schoolid = Schools::where('name',$request['school'])->first();
            $Department->school_id=$schoolid->school_id;
            $Department->save();
            return redirect('/superadmin');
       
        }}
        //Show add users to department form
        public function show_addusers_to_department(){
            $departments = Departments::all();
            return view('superadmindashboard.adduserstodepartment',compact('departments'));
        }

        //To validate and insert users into the department
    public function insert_users_to_department (Request $request){
        // try {
            $request->validate([
                'admin_email' => 'required|email',
                'department' => 'required',
            ]);
    
            $requestedadmin = $request['admin_email'];
    
            // Check if the admin's email exists in the database
            $existingemail = User::where('email', $requestedadmin)->first();
            $existingid = Admins::where('user_id', $existingemail->user_id)->first();
            
            if ($existingid) {
                $usersEmails = $request['users_emails'];
                $userIds = [];
                $nonExistentusersEmails = [];
    
                // Check if each student email exists
                foreach ($usersEmails as $userEmail) {
                    $users = User::where('email', $userEmail)->first();
    
                    if ($users) {
                        $userIds[] = $users->user_id;
                    } else {
                        $nonExistentusersEmails[] = $userEmail;
                    }
                }
    
                if (empty($nonExistentusersEmails)) {
                    $departmentid = Departments::where('name', $request['department'])->first();
    
                    foreach ($userIds as $userId) {
                        $d_users = new Department_users;
                        $d_users->admin_id = $existingid->user_id;
                        $d_users->dep_id = $departmentid->dep_id;
                        $studentID = Students::where('user_id', $userId)->first();
                        $professorID = Professors::where('user_id', $userId)->first();
                        if ($studentID || $professorID) {
                        $d_users->user_id = $userId;
                        $d_users->save();}
                        else{
                            return redirect()->route('add_users_to_department')->withError('Do not add admins email in student & professor email field');
                        }
                    }
    
                    return redirect('/superadmin');
                } else {
                    // Handle the case where some user emails do not exist
                    $errorMessage = 'The following user emails do not exist: ' . implode(', ', $nonExistentusersEmails);
                    return redirect()->route('add_users_to_department')->withError($errorMessage);
                }
            } else {
                // Handle the case where the professor's email does not exist
                return redirect()->route('add_users_to_department')->withError('The email of the admin does not exist');
            }
        // } catch (QueryException $e) {
        //     // Handle database-related exceptions, e.g., database connection issues or constraint violations
        //     $errorMessage = 'An error occurred while inserting data. Please try again later.';
        //     return redirect()->route('add_users_to_department')->withError($errorMessage);
        // } catch (\Exception $e) {
        //     // Handle other exceptions that may occur
        //     $errorMessage = 'An unexpected error occurred. Please try again later.';
        //     return redirect()->route('add_users_to_department')->withError($errorMessage);
        // }
    
            
        }
}
