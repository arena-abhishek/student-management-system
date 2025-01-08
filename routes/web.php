<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/login', [AdminController::class, 'index'])->name('admin.login');

Route::get('admin/registered', [AdminController::class, 'register'])->name('admin.register');

Route::post('admin/login', [AdminController::class, 'authenticate'])->name('admin.authenticate');

Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

Route::get('admin/form', [AdminController::class, 'form'])->name('admin.form');

Route::get('admin/table', [AdminController::class, 'table'])->name('admin.form');
