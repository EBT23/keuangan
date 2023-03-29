<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\PosisiController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PenggajianController;
use App\Http\Controllers\PenjabController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DashboardController;


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


Route::get('/', function () {
    return view('auth.login');
});


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
Route::get('/distributor', [DistributorController::class, 'distributor'])->name('distributor');
Route::get('/posisi', [PosisiController::class, 'posisi'])->name('posisi');
Route::get('/pengeluaran', [PengeluaranController::class, 'pengeluaran'])->name('pengeluaran');
Route::get('/pemasukan', [PemasukanController::class, 'pemasukan'])->name('pemasukan');
Route::get('/penggajian', [PenggajianController::class, 'penggajian'])->name('penggajian');
Route::get('/penjab', [PenjabController::class, 'penjab'])->name('penjab');
Route::get('/role', [RoleController::class, 'role'])->name('role');