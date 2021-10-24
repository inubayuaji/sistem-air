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

    Route::get('/ganti-password', 'AuthController@changePassword')->name('password.ganti');
    Route::post('/ganti-password', 'AuthController@updatePassword')->name('password.ubah');

    Route::group(['prefix' => 'desa', 'as' => 'desa.'], function() {
        Route::get('/', 'DesaController@index')
            ->middleware('permission:desa.daftar')
            ->name('index');
        Route::get('/tambah', 'DesaController@create')
            ->middleware('permission:desa.tambah')
            ->name('tambah');
        Route::post('/', 'DesaController@store')
            ->name('simpan');
        Route::get('/{id}', 'DesaController@show')
            ->middleware('permission:desa.detail')
            ->name('detail');
        Route::get('/{id}/ubah', 'DesaController@edit')
            ->middleware('permission:desa.ubah')
            ->name('ubah');
        Route::post('/{id}', 'DesaController@update')
            ->name('update');
        Route::post('/{id}/hapus', 'DesaController@destroy')
            ->middleware('permission:desa.hapus')
            ->name('hapus');
    });

    Route::group(['prefix' => 'pelanggan', 'as' => 'pelanggan.'], function() {
        Route::get('/', 'PelangganController@index')
            ->middleware('permission:pelanggan.daftar')
            ->name('index');
        Route::get('/tambah', 'PelangganController@create')
            ->middleware('permission:pelanggan.tambah')
            ->name('tambah');
        Route::post('/', 'PelangganController@store')
            ->name('simpan');
        Route::get('/{id}', 'PelangganController@show')
            ->middleware('permission:pelanggan.detail')
            ->name('detail');
        Route::get('/{id}/ubah', 'PelangganController@edit')
            ->middleware('permission:pelanggan.ubah')
            ->name('ubah');
        Route::post('/{id}', 'PelangganController@update')
            ->name('update');
        Route::post('/{id}/hapus', 'PelangganController@destroy')
            ->middleware('permission:pelanggan.hapus')
        ->name('hapus');
        Route::get('/{id}/kartu', 'PelangganController@kartu')
            ->middleware('permission:pelanggan.print')
            ->name('kartu');
        Route::get('/{id}/tagihan', 'PelangganController@tagihan')
            ->middleware('permission:pelanggan.tagihan')
            ->name('tagihan');
        Route::get('/{id}/tagihan/{tagihan_id}/edit', 'PelangganController@editTagihan')
            ->middleware('permission:pelanggan.tagihan') // ganti permission
            ->name('edit');
        Route::post('/{id}/tagihan/{tagihan_id}/edit', 'PelangganController@editUpdate')
            ->middleware('permission:pelanggan.tagihan') // ganti permission
            ->name('update-edit');
        Route::get('/{id}/tagihan/{tagihan_id}/bayar', 'PembayaranController@index')
            ->middleware('permission:pelanggan.tagihan_bayar')
            ->name('pembayaran');
        Route::post('/{id}/tagihan/{tagihan_id}/bayar', 'PembayaranController@bayar')
            ->name('bayar');
    });

    Route::group(['prefix' => 'buku-tahun', 'as' => 'buku_tahun.'], function() {
        Route::get('/', 'BukuTahunController@index')
            ->middleware('permission:buku_tahun.daftar')
            ->name('index');
        Route::get('/tambah', 'BukuTahunController@create')
            ->middleware('permission:buku_tahun.tambah')
            ->name('tambah');
        Route::post('/', 'BukuTahunController@store')
            ->name('simpan');
        Route::get('/{id}', 'BukuTahunController@show')
            ->middleware('permission:buku_tahun.detail')    
            ->name('detail');
        Route::post('/{id}/hapus', 'BukuTahunController@destroy')
            ->middleware('permission:buku_tahun.hapus')
            ->name('hapus');
        Route::get('/{id}/tagihan', 'BukuTahunController@tagihan')
            ->middleware('permission:buku_tahun.tagihan')
            ->name('tagihan');
        Route::post('/tahun-aktif', 'BukuTahunController@gantiTahunAktif')
            ->middleware('permission:buku_tahun.tahun_aktif')
            ->name('ganti_tahun');
    });

    Route::group(['prefix' => 'pendataan', 'as' => 'pendataan.'], function() {
        Route::get('/', 'PendataanController@index')
            ->middleware('permission:pendataan.daftar')
            ->name('index');
        Route::get('/{id}/tagihan/{tagihan_id}/ubah', 'PendataanController@edit')
            ->middleware('permission:pendataan.tagihan_ubah')
            ->name('ubah');
        Route::post('/{id}/tagihan/{tagihan_id}/ubah', 'PendataanController@update')
            ->name('update');
        Route::get('/{id}/tagihan', 'PendataanController@tagihan')
            ->middleware('permission:pendataan.tagihan')
            ->name('tagihan');
    });

    Route::group(['prefix' => 'anggota', 'as' => 'anggota.', 'namespace' => 'Anggota'], function() {
        Route::group(['prefix' => 'daftar', 'as' => 'daftar.'], function() {
            Route::get('/', 'DaftarController@index')
                ->middleware('permission:anggota.daftar')
                ->name('index');
            Route::get('/tambah', 'DaftarController@create')
                ->middleware('permission:anggota.tambah')
                ->name('tambah');
            Route::post('/', 'DaftarController@store')
                ->name('simpan');
            Route::get('/{id}', 'DaftarController@show')
                ->middleware('permission:anggota.detail')
                ->name('detail');
            Route::get('/{id}/ubah', 'DaftarController@edit')
                ->middleware('permission:anggota.ubah')
                ->name('ubah');
            Route::post('/{id}', 'DaftarController@update')
                ->name('update');
            Route::post('/{id}/hapus', 'DaftarController@destroy')->name('hapus');
        });

        Route::group(['prefix' => 'role', 'as' => 'role.'], function() {
            Route::get('/', 'RoleController@index')
                ->middleware('permission:anggota.daftar')
                ->name('index');
            // Route::get('/tambah', 'RoleController@create')->name('tambah');
            // Route::post('/', 'RoleController@store')->name('simpan');
            // Route::get('/{id}', 'RoleController@show')->name('detail');
            // Route::get('/{id}/ubah', 'RoleController@edit')->name('ubah');
            // Route::post('/{id}', 'RoleController@update')->name('update');
            // Route::post('/{id}/hapus', 'RoleController@destroy')->name('hapus');
        });

        Route::group(['prefix' => 'permission', 'as' => 'permission.'], function() {
            Route::get('/', 'PermissionController@index')
                ->middleware('permission:anggota.daftar')
                ->name('index');
            // // Route::get('/tambah', 'PermissionController@create')->name('tambah');
            // Route::post('/', 'PermissionController@store')->name('simpan');
            // Route::get('/{id}', 'PermissionController@show')->name('detail');
            // Route::get('/{id}/ubah', 'PermissionController@edit')->name('ubah');
            // Route::post('/{id}', 'PermissionController@update')->name('update');
            // Route::post('/{id}/hapus', 'PermissionController@destroy')->name('hapus');
        });
    });
});
