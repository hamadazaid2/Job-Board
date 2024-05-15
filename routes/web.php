<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;


Route::get('/', fn() => to_route('jobs.index'));

Route::resource('jobs', JobController::class)
    ->only(['index', 'show']);

Route::get('login', fn() => to_route('auth.create'))->name('login');
Route::resource('auth', AuthController::class)
    ->only(['create', 'store']);


// we use delete not get for logout in order to use csrf so we can protect session data !
// if we use get, anyone can access the session data nd read it 
Route::delete('logout', fn() => to_route('auth.destroy'))->name('logout');
Route::delete('auth', [AuthController::class, 'destroy'])
    ->name('auth.destroy');

Route::middleware('auth')->group(function () {
    Route::resource('job.application', JobApplicationController::class)
        ->only(['create', 'store']);
});