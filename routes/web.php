<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\KioskController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::resource('/manage-sales', SaleController::class);

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('kiosks', KioskController::class);
    Route::resource('applications', ApplicationController::class);
    Route::put('/applications/{application}/updateStatus', [ApplicationController::class, 'updateStatus'])->name('applications.updateStatus');
    Route::resource('sales', SaleController::class);
    Route::resource('transactions', TransactionController::class);
    Route::resource('complaints', ComplaintController::class);
});
