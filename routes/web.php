<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperadminController;
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


Route::get('/superadmin',[SuperadminController::class,'showsuperadmin']);

Route::get('/professor', function () {
    return view('professor');
});

Route::get('/admin',[AdminController::class,'showadmin']);

Route::get('/admin/add',[AdminController::class,'showaddadmin'])->name('addadmin');

Route::post('/admin/add',[AdminController::class,'insertadmin']);

Route::get('/student',[StudentController::class,'showstudent']);

Route::get('/admin/addstudents',[StudentController::class,'addstudents'])->name('student');

Route::post('/admin/addstudents',[StudentController::class,'insertstudents']);

Route::get('/admin/addprofessors',[ProfessorController::class,'addprofessors'])->name('professor');

Route::post('/admin/addprofessors',[ProfessorController::class,'insertprofessors']);

Route::get('/login', function () {
    return view('login');
});

Route::get('/login',[LoginController::class,'loginpage'])->name('login');

Route::post('/login',[LoginController::class,'login']);

Route::get('/logout',[LoginController::class,'logout']);

Route::get('/test', function () {
    return view('test');
});
