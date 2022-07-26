<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Services\AuthService;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home']);

Route::post('auth/logout', function() {
    return AuthService::logout();
});

Route::middleware('is_guest')->group(function () {
    Route::get('/ref/{reflink}', function($reflink){
        return redirect()->route('auth.register', ['reflink' => $reflink]);
    })->name('auth.reflink');

    Route::prefix('auth')->name('auth.')->group(function () {
        Route::get('login', [AuthController::class, 'login'])->name('login');
        Route::post('login', [AuthController::class, 'loginPost'])->name('login.post');
        Route::get('register/{reflink?}', [AuthController::class, 'register'])->name('register');
        Route::post('register', [AuthController::class, 'registerPost'])->name('register.post');
    });
});

Route::middleware('is_customer')->group(function() {
    Route::get('list-member', [HomeController::class, 'listMember'])->name('list-member');
    Route::get('wallet-member', [HomeController::class, 'walletMember'])->name('wallet-member');
    Route::get('report', [HomeController::class, 'reports'])->name('report');
});

Route::any( '{path}', function(){
    return redirect()->to(RouteServiceProvider::HOME);
});
