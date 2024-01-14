<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\KioskController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SaleController;
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

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('kiosks', KioskController::class);

    Route::resource('applications', ApplicationController::class);
    Route::put('/applications/{application}/updateStatus', [ApplicationController::class, 'updateStatus'])->name('applications.updateStatus');

    Route::resource('sales', SaleController::class);
    Route::get('/sales/show/{id}', [SaleController::class, 'showPupuk'])->name('sales.showPupuk');
    Route::put('/sales/show/{id}', [SaleController::class, 'updatePupuk'])->name('sales.updatePupuk');

    Route::prefix('payments')->group(function () {
        Route::get('bills/', [PaymentController::class, 'indexBill'])->name('payments.index-bill');
        Route::get('bills/{transaction}', [PaymentController::class, 'showBill'])->name('payments.show-bill');

        Route::get('transactions/', [PaymentController::class, 'indexTransaction'])->name('payments.index-transaction');
        Route::post('transactions/', [PaymentController::class, 'generateBill'])->name('payments.store-transaction');
        Route::get('transactions/{transaction}', [PaymentController::class, 'showTransaction'])->name('payments.show-transaction');
    });

    Route::resource('complaints', ComplaintController::class);
    Route::post('/complaints/assign-to/{complaint}', [ComplaintController::class, 'assignTo'])->name('complaints.assignTo');
    Route::post('/complaints/update-status/{complaint}', [ComplaintController::class, 'updateStatus'])->name('complaints.updateStatus');
});
