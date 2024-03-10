<?php

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

Route::get("login", "Auth\LoginController@showLoginForm");
Route::post("login", "Auth\LoginController@login")->name("login");
Route::get('/', function () {
    return redirect('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index');

    //logout
    Route::post("logout", "Auth\LoginController@logout")->name("logout");
    //profil
    Route::get('profil', "profilC@index");
    Route::post('profil/ubahnama', "profilC@ubahnama")->name("ubah.nama");
    Route::post('profil/ubahpassword', "profilC@ubahpassword")->name("ubah.password");
    Route::post('profil/ubahgambar', "profilC@ubahgambar")->name("ubah.gambar");





    //arsip
    Route::resource('arsipku', "arsipkuC");
    Route::post('download/{idarsip}/arsipku', "arsipkuC@download")->name('downloadArsipku');
    Route::get('bagikan/{idarsip}/arsipku', "arsipkuC@bagikan")->name('bagikan');
    Route::post('bagikan/{idarsip}/arsipku', "arsipkuC@prosesbagikan")->name('proses.bagikan');
    Route::post('bagikan/{idarsip}/arsipku/keseluruhan', "arsipkuC@prosesbagikankeseluruhan")->name('proses.bagikan.keseluruhan');

    Route::resource('dibagikan', "dibagikanC");
    Route::post('download/{idarsip}/dibagikan', "dibagikanC@download")->name('downloadDibagikan');


    Route::middleware(['gerbangAdmin'])->group(function () {
        Route::resource('keseluruhan', "keseluruhanC");
        Route::post('download/{idarsip}/keseluruhan', "keseluruhanC@download")->name('downloadKeseluruhan');
        //user
        Route::resource('user', "userC");



        //jabatan
        Route::get("pengaturan", "pengaturanC@index")->name("pengaturan");
        //jabatan
        Route::post("jabatan", "pengaturanC@tambahJabatan")->name("tambahJabatan");
        Route::delete("jabatan/{idjabatan}/hapus", "pengaturanC@hapusJabatan")->name("hapusJabatan");
        Route::put("jabatan/{idjabatan}/ubah", "pengaturanC@ubahJabatan")->name("ubahJabatan");
        //keterangan
        Route::post("keterangan", "pengaturanC@tambahKeterangan")->name("tambahKeterangan");
        Route::delete("keterangan/{idketerangan}/hapus", "pengaturanC@hapusKeterangan")->name("hapusKeterangan");
        Route::put("keterangan/{idketerangan}/ubah", "pengaturanC@ubahKeterangan")->name("ubahKeterangan");
    });






});



// Route::get('pdf', 'startController@pdf');

Route::get('siswa/export/', 'startController@export');



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
