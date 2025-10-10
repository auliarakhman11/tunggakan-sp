<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\LaporanController;
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
//     return view('welcome');
// });

Route::middleware('auth')->group(function () {

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    //home
    Route::get('berkas', [BerkasController::class, 'index'])->name('berkas');
    Route::get('getBerkas', [BerkasController::class, 'getBerkas'])->name('getBerkas');
    Route::post('addBerkas', [BerkasController::class, 'addBerkas'])->name('addBerkas');
    Route::post('editBerkas', [BerkasController::class, 'editBerkas'])->name('editBerkas');
    Route::get('geteditBerkas/{berkas_id}', [BerkasController::class, 'geteditBerkas'])->name('geteditBerkas');
    Route::get('deleteBerkas/{berkas_id}', [BerkasController::class, 'deleteBerkas'])->name('deleteBerkas');
    Route::post('lanjutBerkas', [BerkasController::class, 'lanjutBerkas'])->name('lanjutBerkas');
    Route::get('getDataCatatan/{berkas_id}', [BerkasController::class, 'getDataCatatan'])->name('getDataCatatan');
    Route::post('addCatatan', [BerkasController::class, 'addCatatan'])->name('addCatatan');
    Route::get('hapusCatatan/{catatan_id}', [BerkasController::class, 'hapusCatatan'])->name('hapusCatatan');
    Route::get('getKembaliBerkas/{berkas_id}/{proses_id}', [BerkasController::class,'getKembaliBerkas'])->name('getKembaliBerkas');
    Route::get('kembaliBerkas/{berkas_id}/{proses_id}', [BerkasController::class,'kembaliBerkas'])->name('kembaliBerkas');
    Route::get('historyBerkas/{berkas_id}', [BerkasController::class,'historyBerkas'])->name('historyBerkas');
    Route::get('berkasSelesai',[BerkasController::class,'berkasSelesai'])->name('berkasSelesai');
    Route::get('getBerkasSelesai',[BerkasController::class,'getBerkasSelesai'])->name('getBerkasSelesai');
    //endhome

    //laporan
    Route::get('/',[LaporanController::class,'index'])->name('laporan');
    //endLaporan





    //user
    Route::get('user', [UserController::class, 'index'])->name('user');
    Route::get('get-data-user', [UserController::class, 'getDataUser'])->name('getDataUser');
    Route::post('user', [UserController::class, 'addUser'])->name('addUser');

    Route::get('get-user/{id}', [UserController::class, 'getUser'])->name('getUser');

    Route::post('edit-user', [UserController::class, 'editUser'])->name('editUser');
    //enduser




    //block
    Route::get('forbidden-access', [AuthController::class, 'block'])->name('block');
    //endblock

    Route::get('ganti-password', [UserController::class, 'gantiPassword'])->name('gantiPassword');

    Route::post('edit-password', [UserController::class, 'editPassword'])->name('editPassword');
});


Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'login_page'])->name('loginPage');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});
