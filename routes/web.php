<?php

use App\Http\Controllers\HitungController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
Route::get('/register', 'RegisterController@index')->name('register');
Route::post('/register', 'RegisterController@store');
Route::middleware(['auth', 'level'])->group(
    function () {
        Route::get('/', 'HomeController@show')->name('home')->middleware('auth');

        Route::resource('/mahasiswa', 'MahasiswaController');
        Route::get('/data_mahasiswa/cetak', 'AlternatifController@cetak')->name('data_mahasiswa.cetak');
        Route::resource('/data_mahasiswa', 'AlternatifController');
        Route::get('/data_mahasiswa/periode/{periode_id}', 'AlternatifController@dataPerPeriode')->name('dataPerPeriode');
        Route::get('/data_mahasiswa/cetak/{periode_id}', 'AlternatifController@cetakPerPeriode')->name('cetakPerPeriode');
        Route::resource('/periode', 'PeriodeController');
        Route::get('/kriteria/cetak', 'KriteriaController@cetak')->name('kriteria.cetak');
        Route::resource('/kriteria', 'KriteriaController');
        Route::get('/nilai_mahasiswa/cetak', 'Rel_AlternatifController@cetak')->name('nilai_mahasiswa.cetak');
        Route::resource('nilai_mahasiswa', 'Rel_AlternatifController');
        Route::get('/hitung', 'HitungController@index')->name('hitung.index');
        Route::get('/hitung/periode/{periode_id}', 'HitungController@hitungPerPeriode')->name('hitungPerPeriode');
        Route::get('/hitung/cetak', 'HitungController@cetak')->name('hitung.cetak');
        Route::get('/hitung/cetak/{periode_id}', 'HitungController@cetakPerPeriode')->name('cetakHitungPerPeriode');
        Route::get('/user/profil', 'UserController@profil')->name('user.profil');
        Route::post('/user/profil', 'UserController@profilUpdate')->name('user.profil.update');
        Route::get('/user/password', 'UserController@password')->name('user.password');
        Route::post('/user/password', 'UserController@passwordUpdate')->name('user.password.update');
        Route::get('/user/logout', 'UserController@logout')->name('user.logout');
        Route::resource('user', 'UserController');
    }
);
Route::get('/login', 'UserController@loginForm')->name('login');
Route::post('/login', 'UserController@loginAction')->name('login.action');
