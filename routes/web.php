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

Route::get('/superadmin/addcourse',[CourseController::class,'addcourse'])->name('addcourse');

Route::post('/superadmin/addcourse',[CourseController::class,'insertcourse']);

Route::get('/superadmin',[SuperadminController::class,'showsuperadmin']);

Route::get('/add/department',[DepartmentController::class,'showadddepartment'])->name('adddepartment');

Route::post('/add/department',[DepartmentController::class,'insertdepartment']);

Route::get('/add/program',[ProgramController::class,'showaddprogram'])->name('addprogram');

Route::post('/add/program',[ProgramController::class,'insertprogram']);

Route::get('/add/department/users',[DepartmentController::class,'show_addusers_to_department'])->name('add_users_to_department');

Route::post('/add/department/users',[DepartmentController::class,'insert_users_to_department']);

Route::get('/add/school',[SchoolController::class,'showaddschool'])->name('addschool');

Route::post('/add/school',[SchoolController::class,'insertschool']);

Route::get('professor',[ProfessorController::class,'showprofessors']);

Route::get('/admin',[AdminController::class,'showadmin']);

Route::get('/admin/add',[AdminController::class,'showaddadmin'])->name('addadmin');

Route::post('/admin/add',[AdminController::class,'insertadmin']);

Route::get('/student',[StudentController::class,'showstudent']);

Route::get('/admin/addstudents',[StudentController::class,'addstudents'])->name('student');

Route::post('/admin/addstudents',[StudentController::class,'insertstudents']);

Route::get('/admin/addprofessors',[ProfessorController::class,'addprofessors'])->name('professor');

Route::post('/admin/addprofessors',[ProfessorController::class,'insertprofessors']);

Route::get('/login',[LoginController::class,'loginpage'])->name('login');

Route::post('/login',[LoginController::class,'login']);

Route::get('/logout',[LoginController::class,'logout']);

Route::get('/test', function () {
    return view('test');
});
