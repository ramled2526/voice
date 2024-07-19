<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\LabTechnicianController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AvailabilityController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index']);

Route::get('/student.index', [StudentController::class, 'index'])->name("student.index");
Route::get('/student', [StudentController::class, 'student'])->name('student.student');
Route::post('/student', [StudentController::class, 'save'])->name('student.save');
Route::get('/student.create', [StudentController::class, 'create'])->name('student.create');
Route::post('/student.store', [StudentController::class, 'store'])->name('student.store');
Route::get('/student.edit', [StudentController::class, 'edit'])->name('student.edit');
Route::put('/student/{student}', [StudentController::class, 'update'])->name('student.update');
Route::delete('/student/{student}', [StudentController::class, 'delete'])->name('student.delete');

Route::get('/instructor', [InstructorController::class, 'instructor'])->name('instructor.form');
Route::post('/instructor.store', [InstructorController::class, 'store'])->name('instructor.store');
Route::get('/instructor.index', [InstructorController::class, 'index'])->name('instructor.index');
Route::get('/instructor.edit', [InstructorController::class, 'edit'])->name('instructor.edit');
Route::put('/instructor/{instructor}', [InstructorController::class, 'update'])->name('instructor.update');
Route::delete('/instructor/{instructor}', [InstructorController::class, 'delete'])->name('instructor.delete');

Route::get('/technician', [LabTechnicianController::class, 'technician'])->name('technician.form');
Route::post('/technician.store', [LabTechnicianController::class, 'store'])->name('technician.store');
Route::get('/technician.index', [LabTechnicianController::class, 'index'])->name('technician.index');
Route::get('/technician.edit', [LabTechnicianController::class, 'edit'])->name('technician.edit');
Route::put('/technician/{technician}', [LabTechnicianController::class, 'update'])->name('technician.update');
Route::delete('/technician/{technician}', [LabTechnicianController::class, 'delete'])->name('technician.delete');

Route::get('/admin.login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin-login', [AdminController::class, 'login'])->name('admin-login');
Route::post('/admin-logout', [AdminController::class, 'logout'])->name('admin-logout');
Route::get('/admin.dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/appoint/booking', [BookingController::class, 'show'])->name('appoint.booking');
Route::post('/appointments', [AppointmentController::class, 'save']);
Route::get('/appoint.student', [AppointmentController::class, 'index'])->name('appoint.student');
Route::get('/appoint.edit', [AppointmentController::class, 'edit'])->name('appoint.edit');
Route::put('/appoint/{appoint}', [AppointmentController::class, 'update'])->name('appoint.update');
Route::delete('/appoint/{appoint}', [AppointmentController::class, 'delete'])->name('appoint.delete');

Route::post('/appoint.set', [AvailabilityController::class, 'set'])->name('appoint.set');
Route::get('/appoint.set', [AvailabilityController::class, 'show'])->name('appoint.set');
Route::get('/availability', [AvailabilityController::class, 'getAvailability'])->name('availability.get');














