<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\listController;
use App\Http\Controllers\HomeController;




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
    return view('welcome');
});


//Route::resource('upload', UploadController::class);
Route::get('/upload', 'UploadController@upload');
Route::post('/upload/proses', 'UploadController@proses_upload');


// Route CRUD
// Route::get('/data', 'DataController@index');


//store
//Route::post('/store, UploadController@store')->name('store');

//hapus file
Route::get('/upload/hapus/{id}', 'UploadController@hapus');

//route datatable
Route::get('/table/upload', [UploadController::class, 'upload'])->name('table.gambar');

Route::post('/store, UploadController@store')->name('store');


//Employeecontroller

Route::get('/pegawai', [EmployeeController::class, 'index'])->name('pegawai')->middleware('auth');
//menampilkan tambahdata
Route::get('/tambahpegawai', [EmployeeController::class, 'tambahpegawai'])->name('tambahpegawai');
//menampilkan inserdata
Route::post('/insertdata', [EmployeeController::class, 'insertdata'])->name('insertdata');
//menampilkan edit data
Route::get('/tampilkandata/{id}', [EmployeeController::class, 'tampilkandata'])->name('tampilkandata');
//mengupdate data
Route::post('/updatedata/{id}', [EmployeeController::class, 'updatedata'])->name('updatedata');
// menghapus data
Route::get('/delete/{id}', [EmployeeController::class, 'delete'])->name('delete');

// untuk export pdf
Route::get('/exportpdf', [EmployeeController::class, 'exportpdf'])->name('exportpdf');

// menampilkan list
Route::get('/list', [ListController::class, 'list'])->name('list');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
