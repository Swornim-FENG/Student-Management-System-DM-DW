<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProgramController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/superadmin/course',[CourseController::class,'showcourse']);

Route::get('/admin/course',[CourseController::class,'show_course']);

Route::get('/superadmin/addcourse',[CourseController::class,'addcourse'])->name('addcourse');

Route::post('/superadmin/addcourse',[CourseController::class,'insertcourse']);

Route::get('/admin/addcourse',[CourseController::class,'add_course'])->name('add_course');

Route::post('/admin/addcourse',[CourseController::class,'insert_course']);

Route::get('/superadmin',[SuperadminController::class,'showsuperadmin']);

Route::get('/add/department',[DepartmentController::class,'showadddepartment'])->name('adddepartment');

Route::post('/add/department',[DepartmentController::class,'insertdepartment']);

Route::get('/add/program',[ProgramController::class,'showaddprogram'])->name('addprogram');

Route::post('/add/program',[ProgramController::class,'insertprogram']);

Route::get('/add/department/users',[DepartmentController::class,'show_addusers_to_department'])->name('add_users_to_department');

Route::post('/add/department/users',[DepartmentController::class,'insert_users_to_department']);

Route::get('/add/school',[SchoolController::class,'showaddschool'])->name('addschool');

Route::post('/add/school',[SchoolController::class,'insertschool']);

Route::get('/professor',[ProfessorController::class,'showprofessors']);

Route::get('/admin',[AdminController::class,'showadmin']);

Route::get('/admin/add',[AdminController::class,'showaddadmin'])->name('addadmin');

Route::post('/admin/add',[AdminController::class,'insertadmin']);

Route::get('/student',[StudentController::class,'showstudent']);

Route::get('/admin/addstudents',[StudentController::class,'addstudents'])->name('student');

Route::post('/admin/addstudents',[StudentController::class,'insertstudents']);

Route::get('/admin/addprofessors',[ProfessorController::class,'addprofessors'])->name('professor');

Route::post('/admin/addprofessors',[ProfessorController::class,'insertprofessors']);

Route::get('/superadmin/addprofessors',[ProfessorController::class,'add_professors'])->name('add_professor');

Route::post('/superadmin/addprofessors',[ProfessorController::class,'insert_professors']);

Route::get('/superadmin/addstudents',[StudentController::class,'add_students'])->name('add_student');

Route::post('/superadmin/addstudents',[StudentController::class,'insert_students']);

Route::get('/superadmin/add/student/program',[ProgramController::class,'showadd_student_toprogram'])->name('add_student_toprogram');

Route::post('/superadmin/add/student/program',[ProgramController::class,'insert_student_toprogram']);

Route::get('/admin/add/student/program',[ProgramController::class,'show_add_student_toprogram'])->name('add_stud_ent_toprogram');

Route::post('/admin/add/student/program',[ProgramController::class,'insert_stud_ent_toprogram']);

Route::get('/superadmin/add/professor/program',[ProgramController::class,'showadd_professor_toprogram'])->name('add_professor_toprogram');

Route::post('/superadmin/add/professor/program',[ProgramController::class,'insert_professor_toprogram']);

Route::get('/admin/add/professor/program',[ProgramController::class,'show_add_professor_toprogram'])->name('add_prof_essor_toprogram');

Route::post('/admin/add/professor/program',[ProgramController::class,'insert_prof_essor_toprogram']);

Route::get('/superadmin/add/admin/program',[ProgramController::class,'showadd_admin_toprogram'])->name('add_admin_toprogram');

Route::post('/superadmin/add/admin/program',[ProgramController::class,'insert_admin_toprogram']);

Route::get('/superadmin/program',[ProgramController::class,'showprogram']);

Route::get('/superadmin/assign/course/program',[CourseController::class,'assign_course'])->name('assign_course');

Route::post('/superadmin/assign/course/program',[CourseController::class,'assign_course_toprogram']);

Route::get('/superadmin/assign/student/course',[CourseController::class,'assign_student'])->name('assign_student');

Route::post('/superadmin/assign/student/course',[CourseController::class,'assign_student_tocourse']);

Route::get('/admin/assign/student/course',[CourseController::class,'assign_stud_ent'])->name('assign_stud_ent');

Route::post('/admin/assign/student/course',[CourseController::class,'assign_stud_ent_tocourse']);

Route::get('/superadmin/assign/professor/course',[CourseController::class,'assign_professor'])->name('assign_professor');

Route::post('/superadmin/assign/professor/course',[CourseController::class,'assign_professor_tocourse']);

Route::get('/admin/assign/professor/course',[CourseController::class,'assign_prof_essor'])->name('assign_prof_essor');

Route::post('/admin/assign/professor/course',[CourseController::class,'assign_prof_essor_tocourse']);

Route::get('/login',[LoginController::class,'loginpage'])->name('login');

Route::post('/login',[LoginController::class,'login']);

Route::get('/logout',[LoginController::class,'logout']);

Route::get('/student/grades',[StudentController::class,'students_grades']);

Route::get('/student/courses',[StudentController::class,'students_courses']);

Route::get('/student/individual/courses/{course_id}/{year}/{sem}/{batch}',[StudentController::class,'students_indcourse']);

Route::get('/student/settings',[StudentController::class,'students_settings']);

Route::get('/professor/students',[ProfessorController::class,'showstudents_of_professor']);

Route::get('/professor/course/students/{course_id}/{year}/{sem}/{batch}',[ProfessorController::class,'students_in_course']);

Route::get('/professor/courses',[ProfessorController::class,'showcourses_of_professor']);

Route::get('/professor/grades',[ProfessorController::class,'show_grades']);

Route::get('/professor/analytics',[ProfessorController::class,'show_analytics']);

Route::get('/superadmin/admin',[SuperadminController::class,'showadmin']);

Route::get('/superadmin/school',[SuperadminController::class,'showschool']);

Route::get('/superadmin/department',[SuperadminController::class,'showdepartment']);

Route::get('/superadmin/student',[SuperadminController::class,'showstudent']);

Route::get('/superadmin/professor',[SuperadminController::class,'showprofessor']);

Route::get('/superadmin/student/program/{program_id}',[SuperadminController::class,'showstudent_in_program']);

Route::get('/superadmin/professor/program/{program_id}',[SuperadminController::class,'showprofessor_in_program']);

Route::get('/test', function () {
    return view('test');
});
