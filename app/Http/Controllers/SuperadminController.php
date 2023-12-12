<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperadminController extends Controller
{
    //show admin dashboard
    public function showsuperadmin(){
        return view('superadmindashboard.superadmindashboard');
    }
    //show adminpage of superadmindashboard
    public function showadmin(){
        return view('superadmindashboard.adminpage');
    }

    //show  schoolpage of superadmindashboard
    public function showschool(){
        return view('superadmindashboard.schoolpage');
    }

    //show  departmentpage of superadmindashboard
    public function showdepartment(){
        return view('superadmindashboard.departmentpage');
    }

    //show  studentpage of superadmindashboard
    public function showstudent(){
        return view('superadmindashboard.studentpage');
    }

    //show  students in program of studentpage of superadmindashboard
    public function showstudent_in_program(){
        return view('superadmindashboard.students_in_program');
    }

    //show  professorpage of superadmindashboard
    public function showprofessor(){
        return view('superadmindashboard.professorpage');
    }

    //show  professors in program of professorpage of superadmindashboard
    public function showprofessor_in_program(){
        return view('superadmindashboard.professors_in_program');
    }
    
}
