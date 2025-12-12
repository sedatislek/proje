<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ClubController;
use App\Http\Controllers\Admin\CompetitionController;
use App\Http\Controllers\Admin\ClubCompetitionController;

Route::middleware(['auth','admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

        // Delegasyon – Oy hakkı
        Route::get('/voting-rights', [AdminController::class, 'votingRights'])->name('voting-rights');
        Route::get('/delegates', [AdminController::class, 'delegateVotes'])->name('delegates.index');

        // CRUD Bölümü
        Route::resource('clubs', ClubController::class);
        Route::resource('competitions', CompetitionController::class);
        Route::resource('club-competitions', ClubCompetitionController::class);
    });
