<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\AssignSubjectToClassController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\FeeHeadController;
use App\Http\Controllers\FeeStructureController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'teacher'], function () {
    //guest
    Route::group(['middleware' => 'teacher.guest'], function () {
        Route::get('login', [TeacherController::class, 'login'])->name('teacher.login');
        Route::post('authenticate', [TeacherController::class, 'authenticate'])->name('teacher.authenticate');

    });

    //auth
    Route::group(['middleware' => 'teacher.auth'], function () {
        Route::get('dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
        Route::get('logout', [TeacherController::class, 'logout'])->name('teacher.logout');
        Route::get('change-password', [TeacherController::class, 'changePassword'])->name('teacher.changePassword');
        Route::post('update-password', [TeacherController::class, 'updatePassword'])->name('teacher.updatePassword');

    });

});
Route::group(['prefix' => 'student'], function () {
    //guest
    Route::group(['middleware' => 'guest'], function () {
        Route::get('login', [UserController::class, 'index'])->name('student.login');
        Route::post('authenticate', [UserController::class, 'authenticate'])->name('student.authenticate');

    });

    //auth
    Route::group(['middleware' => 'auth'], function () {
        Route::get('dashboard', [UserController::class, 'dashboard'])->name('student.dashboard');
        Route::get('logout', [UserController::class, 'logout'])->name('student.logout');
        Route::get('change-password', [UserController::class, 'changePassword'])->name('student.changePassword');
        Route::post('update-password', [UserController::class, 'updatePassword'])->name('student.updatePassword');

    });

});

Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('login', [AdminController::class, 'index'])->name('admin.login');

        Route::get('register', [AdminController::class, 'register'])->name('admin.register');

        Route::post('login', [AdminController::class, 'authenticate'])->name('admin.authenticate');

    });
    Route::group(['middleware' => 'admin.auth'], function () {

        // Academic Year Management
        Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');

        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        Route::get('form', [AdminController::class, 'form'])->name('admin.form');

        Route::get('table', [AdminController::class, 'table'])->name('admin.table');

        Route::get('academic-year/create', [AcademicYearController::class, 'index'])->name('academic-year.create');

        Route::post('academic-year/store', [AcademicYearController::class, 'store'])->name('academic-year.store');

        Route::get('academic-year/read', [AcademicYearController::class, 'read'])->name('academic-year.read');

        Route::get('academic-year/edit/{id}', [AcademicYearController::class, 'edit'])->name('academic-year.edit');

        Route::get('academic-year/delete/{id}', [AcademicYearController::class, 'delete'])->name('academic-year.delete');

        Route::post('academic-year/update', [AcademicYearController::class, 'update'])->name('academic-year.update');
        Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');

        // Announcement management

        Route::get('announcement/create', [AnnouncementController::class, 'index'])->name('announcement.create');

        Route::post('announcement/store', [AnnouncementController::class, 'store'])->name('announcement.store');

        Route::get('announcement/read', [AnnouncementController::class, 'read'])->name('announcement.read');

        Route::get('announcement/edit/{id}', [AnnouncementController::class, 'edit'])->name('announcement.edit');

        Route::get('announcement/delete/{id}', [AnnouncementController::class, 'delete'])->name('announcement.delete');

        Route::post('announcement/update/{id}', [AnnouncementController::class, 'update'])->name('announcement.update');

        // Classes management

        Route::get('class/create', [ClassesController::class, 'index'])->name('class.create');

        Route::post('class/store', [ClassesController::class, 'store'])->name('class.store');

        Route::get('class/read', [ClassesController::class, 'read'])->name('class.read');

        Route::get('class/edit/{id}', [ClassesController::class, 'edit'])->name('class.edit');

        Route::get('class/delete/{id}', [ClassesController::class, 'delete'])->name('class.delete');

        Route::post('class/update', [ClassesController::class, 'update'])->name('class.update');

        // Fee Head Management
        Route::get('fee-head/create', [FeeHeadController::class, 'index'])->name('fee-head.create');

        Route::post('fee-head/store', [FeeHeadController::class, 'store'])->name('fee-head.store');

        Route::get('fee-head/read', [FeeHeadController::class, 'read'])->name('fee-head.read');

        Route::get('fee-head/edit/{id}', [FeeHeadController::class, 'edit'])->name('fee-head.edit');

        Route::get('fee-head/delete/{id}', [FeeHeadController::class, 'delete'])->name('fee-head.delete');

        Route::post('fee-head/update', [FeeHeadController::class, 'update'])->name('fee-head.update');

        // Fee Structure
        Route::get('fee-structure/create', [FeeStructureController::class, 'index'])->name('fee-structure.create');

        Route::post('fee-structure/store', [FeeStructureController::class, 'store'])->name('fee-structure.store');

        Route::get('fee-structure/read', [FeeStructureController::class, 'read'])->name('fee-structure.read');

        Route::get('fee-structure/edit/{id}', [FeeStructureController::class, 'edit'])->name('fee-structure.edit');

        Route::get('fee-structure/delete/{id}', [FeeStructureController::class, 'delete'])->name('fee-structure.delete');

        Route::post('fee-structure/update', [FeeStructureController::class, 'update'])->name('fee-structure.update');

        // Student management
        Route::get('student/create', [StudentController::class, 'index'])->name('student.create');

        Route::post('student/store', [StudentController::class, 'store'])->name('student.store');

        Route::get('student/read', [StudentController::class, 'read'])->name('student.read');

        Route::get('student/edit/{id}', [StudentController::class, 'edit'])->name('student.edit');

        Route::get('student/delete/{id}', [StudentController::class, 'delete'])->name('student.delete');

        Route::post('student/update/{id}', [StudentController::class, 'update'])->name('student.update');

        // Subject management
        Route::get('subject/create', [SubjectController::class, 'index'])->name('subject.create');

        Route::post('subject/store', [SubjectController::class, 'store'])->name('subject.store');

        Route::get('subject/read', [SubjectController::class, 'read'])->name('subject.read');

        Route::get('subject/edit/{id}', [SubjectController::class, 'edit'])->name('subject.edit');

        Route::get('subject/delete/{id}', [SubjectController::class, 'delete'])->name('subject.delete');

        Route::post('subject/update/{id}', [SubjectController::class, 'update'])->name('subject.update');

        //Assign subject management
        Route::get('assign-subject/create', [AssignSubjectToClassController::class, 'index'])->name('assign-subject.create');

        Route::post('assign-subject/store', [AssignSubjectToClassController::class, 'store'])->name('assign-subject.store');

        Route::get('assign-subject/read', [AssignSubjectToClassController::class, 'read'])->name('assign-subject.read');

        Route::get('assign-subject/edit/{id}', [AssignSubjectToClassController::class, 'edit'])->name('assign-subject.edit');

        Route::get('assign-subject/delete/{id}', [AssignSubjectToClassController::class, 'delete'])->name('assign-subject.delete');

        Route::post('assign-subject/update/{id}', [AssignSubjectToClassController::class, 'update'])->name('assign-subject.update');

        //Teacher management
        Route::get('teacher/create', [TeacherController::class, 'index'])->name('teacher.create');

        Route::post('teacher/store', [TeacherController::class, 'store'])->name('teacher.store');

        Route::get('teacher/read', [TeacherController::class, 'read'])->name('teacher.read');

        Route::get('teacher/edit/{id}', [TeacherController::class, 'edit'])->name('teacher.edit');

        Route::get('teacher/delete/{id}', [TeacherController::class, 'delete'])->name('teacher.delete');

        Route::post('teacher/update/{id}', [TeacherController::class, 'update'])->name('teacher.update');

    });
});


