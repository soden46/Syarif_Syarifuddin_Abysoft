<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

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

//Dashboard Antrian 
Route::get('/', [AdminController::class, 'index'])->name('home');
// Route Pendaftaran Peserta Vaksin
Route::get('/create', [AdminController::class, 'create'])->name('create');
// Route Insert Data Ke Database Dari Form Registrasi
Route::post('/create/store', [AdminController::class, 'store']);
// Route Depend Provinsi Pada Form Registrasi
Route::get('getKab/{code}', function ($code) {
    $provinsi = App\Models\kabupaten::where('province_code', $code)->get();
    return response()->json($provinsi);
});
// Route Depend Provinsi Pada Form Registrasi
Route::get('getKec/{code}', function ($code) {
    $kabupaten = App\Models\Kecamatan::where('city_code', $code)->get();
    return response()->json($kabupaten);
});
// Download Nomor Antrian
Route::get('/download-antrian/{post}', [AdminController::class, 'antrian']);
Route::post('konfirmasi/{id}', [AdminController::class, 'konfirmasi'])->name('konfirmasi');
Route::get('/antrian-selanjutnya', [AdminController::class, 'next']);
