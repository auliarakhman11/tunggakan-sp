<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KecamatanKelurahanController;
use App\Http\Controllers\PetaController;
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

    //peta
    Route::get('/', [PetaController::class, 'index'])->name('peta');
    Route::get('find-kelurahan/{id}', [PetaController::class, 'findKelurahan'])->name('findKelurahan');
    Route::post('addPeta', [PetaController::class, 'addPeta'])->name('addPeta');
    Route::get('getDataPeta', [PetaController::class, 'getDataPeta'])->name('getDataPeta');
    Route::get('downloadDataPeta/{id}', [PetaController::class, 'downloadDataPeta'])->name('downloadDataPeta');
    Route::get('downloadFilePeta/{file_name}', [PetaController::class, 'downloadFilePeta'])->name('downloadFilePeta');
    Route::get('geteditPeta/{id}', [PetaController::class, 'geteditPeta'])->name('geteditPeta');
    Route::post('editPeta', [PetaController::class, 'editPeta'])->name('editPeta');
    Route::get('deletePeta/{id}', [PetaController::class, 'deletePeta'])->name('deletePeta');
    Route::post('uploadPeta', [PetaController::class, 'uploadPeta'])->name('uploadPeta');
    Route::get('deleteFilePeta/{id}', [PetaController::class, 'deleteFilePeta'])->name('deleteFilePeta');
    //end peta

    Route::middleware('hakakses:1')->group(function () {
        //kecamatan Kelurahan
        Route::get('kecamatan-kelurahan', [KecamatanKelurahanController::class, 'index'])->name('kecamatanKelurahan');

        Route::get('get-data-kecamatan', [KecamatanKelurahanController::class, 'getDataKecamatan'])->name('getDataKecamatan');

        Route::post('add-kecamatan', [KecamatanKelurahanController::class, 'addKecamatan'])->name('addKecamatan');

        Route::get('get-kecamatan/{id}', [KecamatanKelurahanController::class, 'getKecamatan']);

        Route::post('edit-kecamatan', [KecamatanKelurahanController::class, 'editKecamatan'])->name('editKecamatan');

        Route::get('get-data-kelurahan', [KecamatanKelurahanController::class, 'getDataKelurahan'])->name('getDataKelurahan');

        Route::post('add-kelurahan', [KecamatanKelurahanController::class, 'addKelurahan'])->name('addKelurahan');

        Route::get('get-kelurahan/{id}', [KecamatanKelurahanController::class, 'getKelurahan']);

        Route::post('edit-kelurahan', [KecamatanKelurahanController::class, 'editKelurahan'])->name('editKelurahan');

        Route::get('find-kelurahan', [KecamatanKelurahanController::class, 'findKelurahan']);

        Route::get('get-list-kecamatan', [KecamatanKelurahanController::class, 'getListKecamatan'])->name('getListKecamatan');

        //end kecamatan keluarahan

        //user
        Route::get('user', [UserController::class, 'index'])->name('user');
        Route::get('get-data-user', [UserController::class, 'getDataUser'])->name('getDataUser');
        Route::post('user', [UserController::class, 'addUser'])->name('addUser');

        Route::get('get-user/{id}', [UserController::class, 'getUser'])->name('getUser');

        Route::post('edit-user', [UserController::class, 'editUser'])->name('editUser');
        //enduser

    });


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

//surat kosong
Route::get('surat-kosong', [SuratController::class, 'suratKosong'])->name('suratKosong');
//end surat kosong
