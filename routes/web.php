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
use App\Http\Controllers\DatakaryawanController;

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
Route::post('/login', [AuthController::class, 'login_post'])->name('login.post');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'register_post'])->name('register.post');


Route::get('logout', [AuthController::class, 'logout'])->name('keluar');



Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
Route::get('/karyawan', [DatakaryawanController::class, 'karyawan'])->name('karyawan');
Route::get('/distributor', [DistributorController::class, 'distributor'])->name('distributor');
Route::get('/posisi', [PosisiController::class, 'posisi'])->name('posisi');
Route::get('/pengeluaran', [PengeluaranController::class, 'pengeluaran'])->name('pengeluaran');
Route::get('/pemasukan', [PemasukanController::class, 'pemasukan'])->name('pemasukan');
Route::get('/penggajian', [PenggajianController::class, 'penggajian'])->name('penggajian');
Route::get('/penjab', [PenjabController::class, 'penjab'])->name('penjab');
Route::get('/role', [RoleController::class, 'role'])->name('role');