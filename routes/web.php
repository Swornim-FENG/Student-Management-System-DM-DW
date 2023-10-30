<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProfessorController;
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

Route::get('/superadmin', function () {
    return view('superadmindashboard');
});

Route::get('/professor', function () {
    return view('professor');
});

Route::get('/admin', function () {
    return view('admindashboard.admindashboard');
});


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
