<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PenjabController;
use App\Http\Controllers\PosisiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PenggajianController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\PengeluaranController;
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

#DISTRIBUTOR
Route::get('/distributor', [DistributorController::class, 'distributor'])->name('distributor');
Route::post('/tambah_distributor', [DistributorController::class, 'tambah_distributor'])->name('tambah.distributor');
Route::post('/update_distributor/{id}', [DistributorController::class, 'update_distributor'])->name('update.distributor');
Route::get('/edit_distributor/{id}', [DistributorController::class, 'edit_distributor'])->name('edit.distributor');
Route::delete('/delete_distributor/{id}', [DistributorController::class, 'delete_distributor'])->name('delete.distributor');

#POSISI
Route::get('/posisi', [PosisiController::class, 'posisi'])->name('posisi');
Route::post('/tambah_posisi', [PosisiController::class, 'tambah_posisi'])->name('tambah.posisi');
Route::post('/update_posisi/{id}', [PosisiController::class, 'update_posisi'])->name('update.posisi');
Route::get('/edit_posisi/{id}', [PosisiController::class, 'edit_posisi'])->name('edit.posisi');
Route::delete('/delete_posisi/{id}', [PosisiController::class, 'delete_posisi'])->name('delete.posisi');

#Pengeluaran
Route::get('/pengeluaran', [PengeluaranController::class, 'pengeluaran'])->name('pengeluaran');
Route::post('/tambah_pengeluaran', [PengeluaranController::class, 'tambah_pengeluaran'])->name('tambah.pengeluaran');
Route::get('/edit_pengeluaran/{id}', [PengeluaranController::class, 'edit_pengeluaran'])->name('edit.pengeluaran');
Route::post('/update_pengeluaran/{id}', [PengeluaranController::class, 'update_pengeluaran'])->name('update.pengeluaran');
Route::delete('/delete_pengeluaran/{id}', [PengeluaranController::class, 'delete_pengeluaran'])->name('delete.pengeluaran');

#PEMASUKAN
Route::get('/pemasukan', [PemasukanController::class, 'pemasukan'])->name('pemasukan');
Route::post('/tambah_pemasukan', [PemasukanController::class, 'tambah_pemasukan'])->name('tambah.pemasukan');
Route::post('/update_pemasukan/{id}', [PemasukanController::class, 'update_pemasukan'])->name('update.pemasukan');
Route::get('/edit_pemasukan/{id}', [PemasukanController::class, 'edit_pemasukan'])->name('edit.pemasukan');
Route::delete('/delete_pemasukan/{id}', [PemasukanController::class, 'delete_pemasukan'])->name('delete.pemasukan');

Route::get('/penggajian', [PenggajianController::class, 'penggajian'])->name('penggajian');

#PENANGGUNGJAWAB
Route::get('/penjab', [PenjabController::class, 'penjab'])->name('penjab');
Route::post('/tambah_penjab', [PenjabController::class, 'tambah_penjab'])->name('tambah.penjab');
Route::post('/update_penjab/{id}', [PenjabController::class, 'update_penjab'])->name('update.penjab');
Route::get('/edit_penjab/{id}', [PenjabController::class, 'edit_penjab'])->name('edit.penjab');
Route::delete('/delete_penjab/{id}', [PenjabController::class, 'delete_penjab'])->name('delete.penjab');

Route::get('/role', [RoleController::class, 'role'])->name('role');
Route::post('/tambah_role', [RoleController::class, 'tambah_role'])->name('tambah.role');
Route::post('/update_role/{id}', [RoleController::class, 'update_role'])->name('update.role');
Route::get('/edit_role/{id}', [RoleController::class, 'edit_role'])->name('edit.role');
Route::delete('/delete_role/{id}', [RoleController::class, 'delete_role'])->name('delete.role');


Route::get('/route-cache', function () {
    Artisan::call('route:cache');
    return 'Routes cache cleared';
});
Route::get('/config-cache', function () {
    Artisan::call('config:cache');
    return 'Config cache cleared';
});
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return 'Application cache cleared';
});
Route::get('/view-clear', function () {
    Artisan::call('view:clear');
    return 'View cache cleared';
});
Route::get('/optimize', function () {
    Artisan::call('optimize');
    return 'Routes cache cleared';
});
