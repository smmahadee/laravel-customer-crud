<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('welcome');
});

Route::get('/customers/trash', [CustomerController::class, 'trash'])->name('customers.trash');
Route::get('/customers/restore/{id}', [CustomerController::class, 'restore'])->name('customers.restore');
Route::delete('/customers/trash/{id}', [CustomerController::class, 'forceDestroy'])->name('customers.force.destroy');
Route::resource('/customers', CustomerController::class);