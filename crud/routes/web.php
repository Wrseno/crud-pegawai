<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Models\Employee;

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
    $jumlahpegawai = Employee::count();
    $jumlahpegawai_laki = Employee::where('jeniskelamin', 'Laki - Laki')->count();
    $jumlahpegawai_perempuan = Employee::where('jeniskelamin', 'Perempuan')->count();

    return view('welcome', compact('jumlahpegawai', 'jumlahpegawai_laki', 'jumlahpegawai_perempuan'));
})->middleware('auth');;


Route::get('/pegawai', [EmployeeController::class, 'index'])->name('pegawai')->middleware('auth');

Route::get('/tambahpegawai', [EmployeeController::class, 'tambah'])->name('tambahpegawai')->middleware('auth');;
Route::post('/postpegawai', [EmployeeController::class, 'postpegawai'])->name('postpegawai');

Route::get('/tampildata/{id}', [EmployeeController::class, 'tampildata'])->name('tampildata')->middleware('auth');;
Route::post('/updatedata/{id}', [EmployeeController::class, 'updatedata'])->name('updatedata');

Route::get('/delete/{id}', [EmployeeController::class, 'delete'])->name('delete');
Route::get('/exportpdf', [EmployeeController::class, 'exportpdf'])->name('exportpdf');


Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/post.register', [AuthController::class, 'postregister'])->name('post.register');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/post.login', [AuthController::class, 'postlogin'])->name('post.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');