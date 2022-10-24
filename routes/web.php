<?php

use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\BlokController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FaultController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::middleware('auth')->group(function () {

    Route::group(['middleware' => ['admin']], function () {

        // Class Driver
        Route::get('/master/karyawan', [EmployeeController::class, 'getEmployee'])->name('getEmployee');
        Route::get('/master/non-karyawan', [EmployeeController::class, 'getNon'])->name('getNon');
        Route::delete('/delete/{guest:guest_id}/non', [EmployeeController::class, 'destroyNon'])->name('destroyNon');
        Route::get('/edit/{driver:driver_id}/karyawan', [EmployeeController::class, 'editEmployee'])->name('editEmployee');
        Route::patch('/karyawan/{driver:driver_id}/update', [EmployeeController::class, 'setEmployee'])->name('updateEmployee');
        Route::delete('/delete/{driver:driver_id}/karyawan', [EmployeeController::class, 'deleteEmployee'])->name('deleteEmployee');
        //

        // Class Blok
        Route::get('/master/blok', [BlokController::class, 'getBlok'])->name('getBlok');
        Route::get('/master/blok', [BlokController::class, 'getBlok'])->name('getBlok');
        Route::get('/edit/{blok:blok_id}/blok', [BlokController::class, 'editBlok'])->name('editBlok');
        Route::patch('/blok/{blok:blok_id}/update', [BlokController::class, 'setBlok'])->name('setBlok');
        Route::delete('/delete/{blok:blok_id}/blok', [BlokController::class, 'deleteBlok'])->name('deleteBlok');
        Route::post('/add/blok', [BlokController::class, 'addBlok'])->name('addBlok');
        //

        // Class Fault
        Route::get('/master/fault', [FaultController::class, 'getFault'])->name('getFault');
        Route::get('/edit/{fault:fault_id}/fault', [FaultController::class, 'editFault'])->name('editFault');
        Route::patch('/fault/{fault:fault_id}/update', [FaultController::class, 'setFault'])->name('setFault');
        Route::delete('/delete/{fault:fault_id}/fault', [FaultController::class, 'deleteFault'])->name('deleteFault');
        Route::post('/add/fault', [FaultController::class, 'addFault'])->name('addFault');
        //

        // Class User
        Route::get('/master/user', [UserController::class, 'getUser'])->name('getUser');
        Route::post('/add/user', [UserController::class, 'addUser'])->name('addUser');
        //
    });

    // Class Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/pelanggaran', [DashboardController::class, 'pelanggaran'])->name('pelanggaran');
    Route::get('/report', [DashboardController::class, 'getReport'])->name('getReport');
    Route::post('/post/report', [DashboardController::class, 'report'])->name('report');
    Route::get('/detail/{parking:kode_parkir}', [DriverController::class, 'detailKendaraan'])->name('detailKendaraan');
    Route::post('/generate-pdf', [DashboardController::class, 'generatePDF'])->name('generatePDF');
    //

    // CLass Parking
    Route::get('/parkir/masuk', [ParkingController::class, 'getParkirMasuk'])->name('parkirMasuk');
    Route::get('/parkir/keluar', [ParkingController::class, 'getParkirKeluar'])->name('parkirKeluar');
    Route::post('/post/masuk', [ParkingController::class, 'setParkirMasuk'])->name('postMasuk');
    Route::post('/post/keluar', [ParkingController::class, 'parkirKeluar'])->name('postKeluar');
    Route::get('/parkir/masuk/non-karyawan', [ParkingController::class, 'parkirMasukNon'])->name('parkirMasukNon');
    Route::get('/parkir/keluar/non-karyawan', [ParkingController::class, 'parkirKeluarNon'])->name('parkirKeluarNon');
    Route::get('/parkir/fault', [ParkingController::class, 'pelanggaran'])->name('pelanggaran');
    Route::post('/parkir/masuk/non-karyawan', [ParkingController::class, 'postMasukNon'])->name('postMasukNon');
    Route::post('/parkir/keluar/non-karyawan', [ParkingController::class, 'parkirKeluarNon'])->name('postKeluarNon');
    Route::post('/parkir/fault', [ParkingController::class, 'pelanggaran'])->name('pelanggaran');
    Route::delete('/delete/{parking:kode_parkir}/kendaraan', [ParkingController::class, 'destroyKendaraan'])->name('destroyKendaraan');

    // User
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/profile', [UserController::class, 'profil'])->name('profil');
    Route::get('/edit', [UserController::class, 'profil'])->name('profil');
    Route::get('/edit/{user:user_id}/user', [UserController::class, 'editUser'])->name('editUser');
    Route::patch('/user/{user:user_id}/update', [UserController::class, 'updateUser'])->name('updateUser');
    Route::delete('/delete/{user:user_id}/user', [UserController::class, 'destroyUser'])->name('destroyUser');
    Route::get('/changePassword', [UserController::class, 'changePassword'])->name('changePassword');
    Route::patch('/profil/{user:user_id}/update', [UserController::class, 'newPassword'])->name('newPassword');
});

Route::group(['middleware' => ['guest']], function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::get('/register', [LoginController::class, 'getRegister'])->name('getRegister');
    Route::post('/register', [LoginController::class, 'register'])->name('register');
    Route::post('/login', [LoginController::class, 'login'])->name('postLogin');
});

Route::get('/qrcode', [EmployeeController::class, 'getQR'])->name('getQR');
Route::post('/barcode', [EmployeeController::class, 'addEmployee'])->name('addEmployee');
