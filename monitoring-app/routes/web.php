<?php

use App\Http\Controllers\DataAnalisisController;
use App\Http\Livewire\GrafikIna219;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ChartsAPIController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataUsersController;
use App\Http\Controllers\DataDeviceController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\DataDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!

*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [SessionController::class, 'index'])->name('login')->middleware(['guest', 'session.expiry']);
Route::post('/sesi/login', [SessionController::class, 'login']);
Route::get('/sesi/logout', [SessionController::class, 'logout'])->name('logout-due-to-inactivity')->middleware('auth');
Route::get('/data', [DataAnalisisController::class,'index'])->middleware('auth');


// Halaman controller
// Route::resource('dashboard', HalamanController::class);
// Route::get('/dashboard', [HalamanController::class, 'home']);
// Route::get('/battery',GrafikIna219::class);
// Route::get('/battery', [HalamanController::class, 'battery']);
// Route::get('/battery/bacategangan', [MonitoringController::class, 'bacategangan']);
// Route::get('/battery/bacaarus', [MonitoringController::class, 'bacaarus']);
// Route::get('/battery/bacadaya', [MonitoringController::class, 'bacadaya']);
// Route::get('battery',[ChartsAPIController::class, 'updateChart'])->name('api.chart');

//Route Halaman Controller
Route::get('/device', [DataDeviceController::class, 'home'])->middleware(['auth']);
Route::get('home', [HalamanController::class, 'home'])->name('rt.home');
Route::get('/dashboardMonitoring', [DashboardController::class, 'home']);
Route::get('/pengguna', [DataUsersController::class, 'home'])->middleware(['auth','adminAccess']);

// Pengguna Controller
Route::get('/pengguna/tambah', [DataUsersController::class,'tambah'])->middleware(['auth','adminAccess']);
Route::post('/pengguna/tambah/simpan', [DataUsersController::class, 'simpan'])->middleware(['auth','adminAccess']);
Route::get('/pengguna/ubah/{id}', [DataUsersController::class, 'edit'])->middleware(['auth','adminAccess']);
Route::put('/pengguna/ubah/simpan/{id}', [DataUsersController::class, 'update'])->middleware(['auth','adminAccess']);
Route::delete('/pengguna/delete/{id}', [DataUsersController::class,'destroy'])->middleware(['auth','adminAccess']);


//Device Controller
Route::get('/device/tambah', [DataDeviceController::class, 'tambah'])->middleware(['auth','adminAccess']);
Route::post('/device/tambah/simpan', [DataDeviceController::class, 'simpan'])->middleware(['auth','adminAccess']);
Route::get('/device/edit/{id}', [DataDeviceController::class, 'edit'])->middleware(['auth','adminAccess']);
Route::put('/device/{id}', [DataDeviceController::class, 'update'])->middleware(['auth','adminAccess']);
Route::delete('/device/delete/{id}', [DataDeviceController::class, 'destroy'])->middleware(['auth','adminAccess']);
// 


// DataAnalisis
// Route::get('/data/view/pdf', [DataAnalisisController::class, 'viewPDF'])->middleware('auth')->name('data.print');
// Route::post('/data/filter', [DataAnalisisController::class, 'filter']);
// Route::get('/data/filter', [DataAnalisisController::class, 'getDataBySelect'])->middleware('auth')->name('data.print');
// Route::get('/data/exportPDF', [DataAnalisisController::class,'viewPDFs'])->middleware('auth')->name('pdf');
Route::get('/data/filter/{selectedDevice}/{selectedSensor}/{startDate}/{endDate}', [DataAnalisisController::class, 'filterGet']);
// Route::get('/data/print/{selectedDevice}/{selectedSensor}/{startDate}/{endDate}', [DataAnalisisController::class, 'print'])->name('data.print');
Route::get('/data/print', [DataAnalisisController::class, 'print'])->name('data.print');
Route::get('/data/{token}', [DataAnalisisController::class,'getDataSensor'])->name('data.getDataSensor');

//Dashboard Controller

Route::get('/dashboardMonitoring/thigrow', [DashboardController::class,'thigrow'])->middleware('auth');
Route::get('/dashboardMonitoring/thigrow/{token}', [DashboardController::class,'getKode'])->middleware('auth');
Route::get('/dashboardMonitoring/bmp', [DashboardController::class,'bmp'])->middleware('auth');
Route::get('/dashboardMonitoring/bmp/{token}', [DashboardController::class,'getToken'])->middleware('auth');
Route::get('/dashboardMonitoring/thm30d', [DashboardController::class,'thm30d'])->middleware('auth');
Route::get('/dashboardMonitoring/ina219', [DashboardController::class,'ina219'])->middleware('auth');
Route::get('/dashboardMonitoring/{token}', [DashboardController::class,'getKode'])->name('dashboardMonitoring.getKode');
// Route::get('/dashboardMonitoring/bacaData/{token}', [DashboardController::class,'getKode'])->name('dashboardMonitoring.getData');


// Battery Monitoring

// 

// // 
// Route::get('/dashboardMonitoring', [MonitoringController::class, 'home']);
// Route::get('/dashboardMonitoring/{device}/monitoring', [HalamanController::class, 'monitoring']);
// Route::get('/dashboardMonitoring/tambah', [HalamanController::class, 'tambahDashboard']);
// Route::post('/dashboardMonitoring/tambah/simpan', [HalamanController::class, 'simpanDashboard']);
// Route::get('/dashboardMonitoring/{id}/ubah', [HalamanController::class, 'editDashboard']);


// Route::get('/battery', [HalamanController::class, 'battery']);
// Route::get('/pengguna', [HalamanController::class, 'pengguna']);
// Route::get('/soilm', [HalamanController::class, 'sensorTanah']);
// Route::get('/temp', [HalamanController::class, 'sensorUdara']);
// Route::get('DataUsers', [DataUsersController::class, 'index']);

// Route::get('/device', [HalamanController::class, 'device']);
// Route::get('/device/tambah', [HalamanController::class, 'tambahDevice']);
// Route::post('/device/tambah/simpan', [HalamanController::class, 'simpanDevice']);
// Route::get('/device/{id}/ubah', [HalamanController::class, 'editDevice']);
// Route::put('/device/{id}', [HalamanController::class, 'updateDevice']);
// Route::delete('/device/{id}/delete', [HalamanController::class, 'destroyDevice']);