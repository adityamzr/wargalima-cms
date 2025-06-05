<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\NewsController;
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
        Route::get('/{id}/show', 'show');
        Route::get('/{id}/edit', 'edit');
        Route::put('/{id}/update', 'update')->name('family-update');
        Route::delete('/{id}', 'destroy')->name('family-delete');

        // api
        Route::get('/family-datatable', 'dataTable')->name('family-datatable');
        Route::get('/family-member-datatable/{id}', 'family_member_dataTable')->name('family-member-datatable');
        // Route::get('/family-list', 'getList')->name('family-list');
    });

    Route::prefix('member')->controller(MemberController::class)->group(function(){
        Route::get('/', 'index')->name('member');
        Route::get('/create', 'create')->name('member-create');
        Route::post('/create', 'store')->name('member-store');
        Route::get('/{id}/edit', 'edit');
        Route::put('/{id}/update', 'update')->name('member-update');
        Route::delete('/{id}', 'destroy')->name('member-delete');

        // api
        Route::get('/member-datatable', 'dataTable')->name('member-datatable');
    });

    Route::prefix('news')->controller(NewsController::class)->group(function(){
        Route::get('/', 'index')->name('news');
        Route::get('/create', 'create')->name('news-create');
        Route::post('/create', 'store')->name('news-store');
        Route::get('/{id}/edit', 'edit');
        Route::put('/{id}/update', 'update')->name('news-update');
        Route::delete('/{id}', 'destroy')->name('news-delete');

        // api
        Route::get('/news-datatable', 'dataTable')->name('news-datatable');
    });

    Route::prefix('agenda')->controller(AgendaController::class)->group(function(){
        Route::get('/', 'index')->name('agenda');
        Route::get('/create', 'create')->name('agenda-create');
        Route::post('/create', 'store')->name('agenda-store');
        Route::get('/{id}/edit', 'edit');
        Route::put('/{id}/update', 'update')->name('agenda-update');
        Route::delete('/{id}', 'destroy')->name('agenda-delete');

        // api
        Route::get('/agenda-datatable', 'dataTable')->name('agenda-datatable');
    });

    Route::prefix('faq')->controller(FaqController::class)->group(function(){
        Route::get('/', 'index')->name('faq');
        Route::get('/create', 'create')->name('faq-create');
        Route::post('/create', 'store')->name('faq-store');
        Route::get('/{id}/edit', 'edit');
        Route::put('/{id}/update', 'update')->name('faq-update');
        Route::delete('/{id}', 'destroy')->name('faq-delete');

        // api
        Route::get('/faq-datatable', 'dataTable')->name('faq-datatable');
    });

    Route::prefix('submission')->controller(FaqController::class)->group(function(){
        Route::get('/', 'index')->name('submission');
        Route::get('/create', 'create')->name('submission-create');
        Route::post('/create', 'store')->name('submission-store');
        Route::get('/{id}/edit', 'edit');
        Route::put('/{id}/update', 'update')->name('submission-update');
        Route::delete('/{id}', 'destroy')->name('submission-delete');

        // api
        Route::get('/submission-datatable', 'dataTable')->name('submission-datatable');
    });
});