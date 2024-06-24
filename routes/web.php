<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\LabTechnicianController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index']);

Route::get('/student', function () {
    return "Student page";
});

Route::get('/instructor', function () {
    return "Instructor page";
});

Route::get('/lab technician', function () {
    return "Lab Technician page";
});

Route::get('/student', [StudentController::class, 'create'])->name('student');
Route::post('/students', [StudentController::class, 'store'])->name('reg_students.store');

Route::get('/instructor', [InstructorController::class, 'create'])->name('instructor');
Route::post('/instructors', [InstructorController::class, 'store'])->name('reg_instructor.store');

Route::get('/lab technician', [LabTechnicianController::class, 'showRegistration']);
Route::post('/lab technician', [LabTechnicianController::class, 'registerLab']);

Route::get('/admin-login', [AdminController::class, 'showLoginForm'])->name('admin-login');
Route::post('/admin-login', [AdminController::class, 'login'])->name('admin-login-submit');



