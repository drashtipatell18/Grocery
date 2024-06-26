<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

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
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/loginstore', [HomeController::class, 'loginStore'])->name('loginstore');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');