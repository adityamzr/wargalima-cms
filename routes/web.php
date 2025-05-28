<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FamilyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('sign-in');

Route::middleware('auth')->group(function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::controller(DashboardController::class)->group(function(){
        Route::get('/dashboard', 'index')->name('dashboard');
    });

    Route::prefix('family')->controller(FamilyController::class)->group(function(){
        Route::get('/', 'index')->name('family');
        Route::get('/create', 'create')->name('family-create');
        Route::post('/create', 'store')->name('family-store');
        Route::get('/{id}/edit', 'edit');
        Route::put('/{id}/update', 'update')->name('family-update');
        Route::delete('/{id}', 'destroy')->name('family-delete');

        // api
        Route::get('/family-datatable', 'dataTable')->name('family-datatable');
    });
});