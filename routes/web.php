<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PemetaanIspaController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KasusISPAController;
use App\Http\Controllers\PenyakitController;
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

Route::get('/', function () {
    return view('pages.app.dashboard-home');
});

Route::middleware(['auth'])->group(function () {
    Route::get('home', function () {
        return view('pages.app.dashboard-sig', ['type_menu' => '']);
    })->name('home');
    Route::resource('user', UserController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/api/pie-chart-data', [DashboardController::class, 'pieChartData'])->name('dashboard.piechart.data');
});

Route::get('/tambah-data', function () {
    return view('pages.app.tambah-data', ['type_menu' => '']);
})->name('tambah.data');

Route::get('/tambah-data-penduduk', [PendudukController::class, 'getTambahDataPenduduk'])->name('tambah.data.penduduk');
Route::post('/tambah-data-penduduk/store', [PendudukController::class, 'store'])->name('penduduk.store');


Route::get('/dashboard-admin', function () {
    return view('pages.app.dashboard-sig');
})->name('dashboard.admin');

Route::get('/list-data-penduduk', [PendudukController::class, 'viewPenduduk'])->name('list.data.penduduk');
Route::get('/penduduk/edit/{id}', [PendudukController::class, 'edit'])->name('penduduk.edit');
Route::put('/penduduk/update/{id}', [PendudukController::class, 'update'])->name('penduduk.update');
Route::delete('/penduduk/delete/{id}', [PendudukController::class, 'delete'])->name('penduduk.delete');

// Route untuk CRUD PemetaanIspa
Route::post('/tambah-data/store', [PemetaanIspaController::class, 'store'])->name('pemetaan.store');
Route::get('/list-data', [PemetaanIspaController::class, 'index'])->name('list.data');
Route::get('/edit-data/{id}', [PemetaanIspaController::class, 'edit'])->name('pemetaan.edit');
Route::put('/update-data/{id}', [PemetaanIspaController::class, 'update'])->name('pemetaan.update');
Route::delete('/delete-data/{id}', [PemetaanIspaController::class, 'destroy'])->name('pemetaan.destroy');
Route::get('/get-locations', [PemetaanIspaController::class, 'getLocations'])->name('get.locations');

Route::get('/data-desa', [PemetaanIspaController::class, 'showDataDesa'])->name('data.desa');
Route::get('/data-desa/{id}', [PemetaanIspaController::class, 'showDetail'])->name('data.desa.detail');

Route::resource('kasus-ispa', KasusISPAController::class);
Route::resource('penyakit', PenyakitController::class);

Route::get('/kasus-ispa', [KasusISPAController::class, 'index'])->name('kasus-ispa.index');
Route::get('/desa/{id}', [KasusISPAController::class, 'show'])->name('desa.show');














// Route::get('/dashboard-home', function () {
//     return view('pages.depan.dashboard-home', ['type_menu' => '']);
// })->name('dashboard.home');





// Route::get('/register', function () {
//     return view('pages.auth.auth-register');
// })->name('register');

// Route::get('/forgot', function () {
//     return view('pages.auth.auth-forgot-password');
// })->name('forgot');

// Route::get('/reset-password', function () {
//     return view('pages.auth.auth-reset-password');
// })->name('reset-password');