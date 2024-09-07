<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DomainController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Auth
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'authenticate'])->name('authenticate');

Route::middleware(['auth'])->group(function () {

    // Accounts
    Route::prefix('accounts')
        ->name('accounts.')
        ->group(function () {
            Route::get('/', [AccountController::class, 'index'])->name('index');
            Route::get('/create', [AccountController::class, 'create'])->name('create');
            Route::post('/', [AccountController::class, 'store'])->name('store');
            Route::get('/{account}/edit', [AccountController::class, 'edit'])->name('edit');
            Route::post('/{account}/update', [AccountController::class, 'update'])->name('update');
            Route::post('/{account}/delete', [AccountController::class, 'delete'])->name('delete');
        });

    // Domains
    Route::prefix('domains')
        ->name('domains.')
        ->group(function () {
            Route::get('/{account}', [DomainController::class, 'index'])->name('index');
            Route::get('/{account}/create', [DomainController::class, 'create'])->name('create');
            Route::post('/{account}/store', [DomainController::class, 'store'])->name('store');
            Route::get('/{account}/ssl/{domain}', [DomainController::class, 'editSsl'])->name('ssl-edit');
            Route::post('/{account}/ssl/{domain}/update', [DomainController::class, 'updateSSL'])->name('update-ssl');
        });
});
