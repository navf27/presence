<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('dashboard');
// });

//Auth Guest
Route::middleware(['guest'])->group(function () {
    Route::get('/sign-in', [AuthController::class, 'index'])->name('login');
    Route::get('/sign-up', [UserController::class, 'create'])->name('signUpView');
    Route::post('/sign-up', [UserController::class, 'store'])->name('signUpStore');
    Route::post('/sign-in', [AuthController::class, 'authenticate'])->name('signInAuth');
});

//Dashboard
Route::middleware(['isAdmin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('userView');
    Route::get('/divisions', [DivisiController::class, 'index'])->name('divisionView');
    Route::post('/divisions', [DivisiController::class, 'store'])->name('addDivisionStore');
    Route::delete('/divisions/delete/{divisi}', [DivisiController::class, 'destroy'])->name('deleteDivision');
    Route::put('/divisions/edit/{divisi}', [DivisiController::class, 'update'])->name('editDivisionStore');
    Route::get('/presences', [PresenceController::class, 'index'])->name('presenceView');
    Route::post('/presences/clean', [PresenceController::class, 'clean'])->name('cleanPresence');
    Route::post('/users', [UserController::class, 'addStore'])->name('addUserStore');
    Route::post('/users/edit/{id}', [UserController::class, 'update'])->name('editUserStore');
    Route::post('/users/delete/{id}', [UserController::class, 'destroy'])->name('deleteUser');
});

//Auth Auth
Route::middleware(['auth'])->group(function () {
    Route::get('/presencesis', [PresenceController::class, 'index'])->name('presenceLog');
    Route::post('/sign-out', [AuthController::class, 'logout'])->name('logout');
    Route::get('/presence', [PresenceController::class, 'presence'])->name('presence');
});


