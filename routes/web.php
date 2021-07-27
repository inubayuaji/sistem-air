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

Route::get('/', function(){
    return redirect()->route('admin.dash');
});

Route::get('/login', 'AuthController@login')->name('login');
Route::get('/logout', 'AuthController@logout')->name('logout');
Route::post('/login', 'AuthController@attempt')->name('attempt');

Route::group(['prefix' => '/admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', 'DashController@index')->name('dash');

    Route::group(['prefix' => 'desa', 'as' => 'desa.'], function() {
        Route::get('/', 'DesaController@index')->name('index');
        Route::get('/tambah', 'DesaController@create')->name('tambah');
        Route::post('/', 'DesaController@store')->name('simpan');
        Route::get('/{id}', 'DesaController@show')->name('detail');
        Route::get('/{id}/ubah', 'DesaController@edit')->name('ubah');
        Route::post('/{id}', 'DesaController@update')->name('update');
        Route::post('/{id}/hapus', 'DesaController@destroy')->name('hapus');
    });

    Route::group(['prefix' => 'pelanggan', 'as' => 'pelanggan.'], function() {
        Route::get('/', 'PelangganController@index')->name('index');
        Route::get('/tambah', 'PelangganController@create')->name('tambah');
        Route::post('/', 'PelangganController@store')->name('simpan');
        Route::get('/{id}', 'PelangganController@show')->name('detail');
        Route::get('/{id}/ubah', 'PelangganController@edit')->name('ubah');
        Route::post('/{id}', 'PelangganController@update')->name('update');
        Route::post('/{id}/hapus', 'PelangganController@destroy')->name('hapus');
        Route::get('/{id}/tagihan', 'PelangganController@tagihan')->name('tagihan');
    });

    Route::group(['prefix' => 'buku-tahun', 'as' => 'buku_tahun.'], function() {
        Route::get('/', 'BukuTahunController@index')->name('index');
        Route::get('/tambah', 'BukuTahunController@create')->name('tambah');
        Route::post('/', 'BukuTahunController@store')->name('simpan');
        Route::get('/{id}', 'BukuTahunController@show')->name('detail');
        Route::post('/{id}/hapus', 'BukuTahunController@destroy')->name('hapus');
        Route::get('/{id}/tagihan', 'BukuTahunController@tagihan')->name('tagihan');
        Route::post('/tahun-aktif', 'BukuTahunController@gantiTahunAktif')->name('ganti_tahun');
    });

    Route::group(['prefix' => 'pendataan', 'as' => 'pendataan.'], function() {
        Route::get('/', 'PendataanController@index')->name('index');
        // Route::get('/tambah', 'DesaController@create')->name('tambah');
        // Route::post('/', 'DesaController@store')->name('simpan');
        // Route::get('/{id}', 'DesaController@show')->name('detail');
        Route::get('/{id}/ubah', 'PendataanController@edit')->name('ubah');
        Route::post('/{id}', 'PendataanController@update')->name('update');
        Route::get('/{id}/tagihan', 'PendataanController@tagihan')->name('tagihan');
    });

    Route::group(['prefix' => 'anggota', 'as' => 'anggota.', 'namespace' => 'Anggota'], function() {
        Route::group(['prefix' => 'daftar', 'as' => 'daftar.'], function() {
            Route::get('/', 'DaftarController@index')->name('index');
            Route::get('/tambah', 'DaftarController@create')->name('tambah');
            Route::post('/', 'DaftarController@store')->name('simpan');
            Route::get('/{id}', 'DaftarController@show')->name('detail');
            Route::get('/{id}/ubah', 'DaftarController@edit')->name('ubah');
            Route::post('/{id}', 'DaftarController@update')->name('update');
            Route::post('/{id}/hapus', 'DaftarController@destroy')->name('hapus');
        });

        Route::group(['prefix' => 'role', 'as' => 'role.'], function() {
            Route::get('/', 'RoleController@index')->name('index');
            Route::get('/tambah', 'RoleController@create')->name('tambah');
            Route::post('/', 'RoleController@store')->name('simpan');
            Route::get('/{id}', 'RoleController@show')->name('detail');
            Route::get('/{id}/ubah', 'RoleController@edit')->name('ubah');
            Route::post('/{id}', 'RoleController@update')->name('update');
            Route::post('/{id}/hapus', 'RoleController@destroy')->name('hapus');
        });

        Route::group(['prefix' => 'permission', 'as' => 'permission.'], function() {
            Route::get('/', 'PermissionController@index')->name('index');
            Route::get('/tambah', 'PermissionController@create')->name('tambah');
            Route::post('/', 'PermissionController@store')->name('simpan');
            Route::get('/{id}', 'PermissionController@show')->name('detail');
            Route::get('/{id}/ubah', 'PermissionController@edit')->name('ubah');
            Route::post('/{id}', 'PermissionController@update')->name('update');
            Route::post('/{id}/hapus', 'PermissionController@destroy')->name('hapus');
        });
    });
});
