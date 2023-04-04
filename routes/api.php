<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ApiAdminController;
use App\Http\Controllers\api\ApiAuthController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [ApiAuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [ApiAuthController::class, 'logout']);
    Route::get('/me', [ApiAuthController::class, 'me']);

    Route::get('/karyawan', [ApiAdminController::class, 'karyawan']);
    Route::post('/tambah_karyawan', [ApiAdminController::class, 'tambah_karyawan']);
    Route::put('/update_karyawan/{id}', [ApiAdminController::class, 'update_karyawan']);
    Route::delete('/delete_karyawan/{id}', [ApiAdminController::class, 'delete_karyawan']);
    Route::get('/get_karyawan_by_id/{id}', [ApiAdminController::class, 'get_karyawan_by_id']);

    Route::get('/pengeluaran', [ApiAdminController::class, 'pengeluaran']);
    Route::post('/tambah_pengeluaran', [ApiAdminController::class, 'tambah_pengeluaran']);
    Route::put('/update_pengeluaran/{id}', [ApiAdminController::class, 'update_pengeluaran']);
    Route::delete('/delete_pengeluaran/{id}', [ApiAdminController::class, 'delete_pengeluaran']);
    Route::get('/get_pengeluaran_by_id/{id}', [ApiAdminController::class, 'get_pengeluaran_by_id']);

    Route::get('/pemasukan', [ApiAdminController::class, 'pemasukan']);
    Route::post('/tambah_pemasukan', [ApiAdminController::class, 'tambah_pemasukan']);
    Route::put('/update_pemasukan/{id}', [ApiAdminController::class, 'update_pemasukan']);
    Route::delete('/delete_pemasukan/{id}', [ApiAdminController::class, 'delete_pemasukan']);
    Route::get('/get_pemasukan_by_id/{id}', [ApiAdminController::class, 'get_pemasukan_by_id']);

    Route::get('/distributor', [ApiAdminController::class, 'distributor']);
    Route::post('/tambah_distributor', [ApiAdminController::class, 'tambah_distributor']);
    Route::put('/update_distributor/{id}', [ApiAdminController::class, 'update_distributor']);
    Route::delete('/delete_distributor/{id}', [ApiAdminController::class, 'delete_distributor']);
    Route::get('/get_distributor_by_id/{id}', [ApiAdminController::class, 'get_distributor_by_id']);

    Route::get('/penjab', [ApiAdminController::class, 'penjab']);
    Route::post('/tambah_penjab', [ApiAdminController::class, 'tambah_penjab']);
    Route::put('/update_penjab/{id}', [ApiAdminController::class, 'update_penjab']);
    Route::delete('/delete_penjab/{id}', [ApiAdminController::class, 'delete_penjab']);
    Route::get('/get_penjab_by_id/{id}', [ApiAdminController::class, 'get_penjabId']);

    Route::get('/posisi', [ApiAdminController::class, 'posisi']);
    Route::post('/tambah_posisi', [ApiAdminController::class, 'tambah_posisi']);
    Route::put('/update_posisi/{id}', [ApiAdminController::class, 'update_posisi']);
    Route::delete('/delete_posisi/{id}', [ApiAdminController::class, 'delete_posisi']);
    Route::get('/get_posisi_by_id/{id}', [ApiAdminController::class, 'get_posisiId']);

    Route::get('/penggajian', [ApiAdminController::class, 'penggajian']);

    Route::get('/karyawan', [ApiAdminController::class, 'karyawan']);
    Route::post('/tambah_karyawan', [ApiAdminController::class, 'tambah_karyawan']);
    Route::put('/update_karyawan/{id}', [ApiAdminController::class, 'update_karyawan']);
    Route::delete('/delete_karyawan/{id}', [ApiAdminController::class, 'delete_karyawan']);
    Route::get('/get_karyawan_by_id/{id}', [ApiAdminController::class, 'get_karyawan_id']);

    Route::get('/role', [ApiAdminController::class, 'role']);
    Route::post('/tambah_role', [ApiAdminController::class, 'tambah_role']);
    Route::put('/update_role/{id}', [ApiAdminController::class, 'update_role']);
    Route::delete('/delete_role/{id}', [ApiAdminController::class, 'delete_role']);
    Route::get('/get_role_by_id/{id}', [ApiAdminController::class, 'get_roleId']);
});
