<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmployeeController;

// for produts
Route::get('/products', [ProductController::class,'index']);
Route::post('/products123', [ProductController::class,'store']);
Route::put('/products/{id}', [ProductController::class,'update']);
Route::delete('/products/{id}', [ProductController::class,'destroy']);
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');


// for employee
Route::get('/employees', [EmployeeController::class,'index']);
Route::post('/employees', [EmployeeController::class,'store']);
Route::put('/employees/{id}', [EmployeeController::class,'update']);
Route::delete('/employees/{id}', [EmployeeController::class,'destroy']);
Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');

