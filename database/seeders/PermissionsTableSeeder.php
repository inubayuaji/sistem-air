<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => '1',
                'name' => 'buku_tahun.daftar',
                'guard_name' => 'web',
                'deskripsi' => NULL,
                'created_at' => '2021-08-07 04:27:57',
                'updated_at' => '2021-08-07 04:27:57',
            ),
            1 => 
            array (
                'id' => '2',
                'name' => 'buku_tahun.detail',
                'guard_name' => 'web',
                'deskripsi' => NULL,
                'created_at' => '2021-08-07 04:28:11',
                'updated_at' => '2021-08-07 04:28:11',
            ),
            2 => 
            array (
                'id' => '3',
                'name' => 'buku_tahun.tambah',
                'guard_name' => 'web',
                'deskripsi' => NULL,
                'created_at' => '2021-08-07 04:28:52',
                'updated_at' => '2021-08-07 04:28:52',
            ),
            3 => 
            array (
                'id' => '4',
                'name' => 'buku_tahun.hapus',
                'guard_name' => 'web',
                'deskripsi' => NULL,
                'created_at' => '2021-08-07 04:29:04',
                'updated_at' => '2021-08-07 04:29:04',
            ),
            4 => 
            array (
                'id' => '5',
                'name' => 'buku_tahun.tahun_aktif',
                'guard_name' => 'web',
                'deskripsi' => NULL,
                'created_at' => '2021-08-07 04:29:42',
                'updated_at' => '2021-08-07 04:29:42',
            ),
            5 => 
            array (
                'id' => '6',
                'name' => 'buku_tahun.tagihan',
                'guard_name' => 'web',
                'deskripsi' => NULL,
                'created_at' => '2021-08-07 04:29:57',
                'updated_at' => '2021-08-07 04:29:57',
            ),
            6 => 
            array (
                'id' => '7',
                'name' => 'pendataan.daftar',
                'guard_name' => 'web',
                'deskripsi' => NULL,
                'created_at' => '2021-08-07 04:30:42',
                'updated_at' => '2021-08-07 04:30:42',
            ),
            7 => 
            array (
                'id' => '8',
                'name' => 'pendataan.tagihan',
                'guard_name' => 'web',
                'deskripsi' => NULL,
                'created_at' => '2021-08-07 04:31:07',
                'updated_at' => '2021-08-07 04:31:07',
            ),
            8 => 
            array (
                'id' => '9',
                'name' => 'pendataan.tagihan_ubah',
                'guard_name' => 'web',
                'deskripsi' => NULL,
                'created_at' => '2021-08-07 04:31:42',
                'updated_at' => '2021-08-07 04:31:42',
            ),
            9 => 
            array (
                'id' => '10',
                'name' => 'pelanggan.daftar',
                'guard_name' => 'web',
                'deskripsi' => NULL,
                'created_at' => '2021-08-07 04:32:07',
                'updated_at' => '2021-08-07 04:32:07',
            ),
            10 => 
            array (
                'id' => '11',
                'name' => 'pelanggan.detail',
                'guard_name' => 'web',
                'deskripsi' => NULL,
                'created_at' => '2021-08-07 04:32:35',
                'updated_at' => '2021-08-07 04:32:35',
            ),
            11 => 
            array (
                'id' => '12',
                'name' => 'pelanggan.hapus',
                'guard_name' => 'web',
                'deskripsi' => NULL,
                'created_at' => '2021-08-07 04:32:52',
                'updated_at' => '2021-08-07 04:32:52',
            ),
            12 => 
            array (
                'id' => '13',
                'name' => 'pelanggan.tambah',
                'guard_name' => 'web',
                'deskripsi' => NULL,
                'created_at' => '2021-08-07 04:38:13',
                'updated_at' => '2021-08-07 04:38:13',
            ),
            13 => 
            array (
                'id' => '14',
                'name' => 'pelanggan.ubah',
                'guard_name' => 'web',
                'deskripsi' => NULL,
                'created_at' => '2021-08-07 04:38:42',
                'updated_at' => '2021-08-07 04:38:42',
            ),
            14 => 
            array (
                'id' => '15',
                'name' => 'pelanggan.print',
                'guard_name' => 'web',
                'deskripsi' => NULL,
                'created_at' => '2021-08-07 04:38:59',
                'updated_at' => '2021-08-07 04:38:59',
            ),
            16 => 
            array (
                'id' => '17',
                'name' => 'pelanggan.tagihan',
                'guard_name' => 'web',
                'deskripsi' => NULL,
                'created_at' => '2021-08-07 04:39:38',
                'updated_at' => '2021-08-07 04:39:38',
            ),
            17 => 
            array (
                'id' => '18',
                'name' => 'pelanggan.tagihan_bayar',
                'guard_name' => 'web',
                'deskripsi' => NULL,
                'created_at' => '2021-08-07 04:40:00',
                'updated_at' => '2021-08-07 04:40:00',
            ),
            18 => 
            array (
                'id' => '19',
                'name' => 'desa.daftar',
                'guard_name' => 'web',
                'deskripsi' => NULL,
                'created_at' => '2021-08-07 04:41:03',
                'updated_at' => '2021-08-07 04:41:03',
            ),
            19 => 
            array (
                'id' => '20',
                'name' => 'desa.detail',
                'guard_name' => 'web',
                'deskripsi' => NULL,
                'created_at' => '2021-08-07 04:41:13',
                'updated_at' => '2021-08-07 04:41:13',
            ),
            20 => 
            array (
                'id' => '21',
                'name' => 'desa.tambah',
                'guard_name' => 'web',
                'deskripsi' => NULL,
                'created_at' => '2021-08-07 04:41:22',
                'updated_at' => '2021-08-07 04:41:22',
            ),
            21 => 
            array (
                'id' => '22',
                'name' => 'desa.ubah',
                'guard_name' => 'web',
                'deskripsi' => NULL,
                'created_at' => '2021-08-07 04:41:33',
                'updated_at' => '2021-08-07 04:41:33',
            ),
            22 => 
            array (
                'id' => '23',
                'name' => 'desa.hapus',
                'guard_name' => 'web',
                'deskripsi' => NULL,
                'created_at' => '2021-08-07 04:41:40',
                'updated_at' => '2021-08-07 04:41:40',
            ),
            23 => 
            array (
                'id' => '24',
                'name' => 'anggota.daftar',
                'guard_name' => 'web',
                'deskripsi' => NULL,
                'created_at' => '2021-08-07 04:45:40',
                'updated_at' => '2021-08-07 04:45:40',
            ),
            24 => 
            array (
                'id' => '25',
                'name' => 'anggota.tambah',
                'guard_name' => 'web',
                'deskripsi' => NULL,
                'created_at' => '2021-08-07 04:45:50',
                'updated_at' => '2021-08-07 04:45:50',
            ),
            25 => 
            array (
                'id' => '26',
                'name' => 'anggota.hapus',
                'guard_name' => 'web',
                'deskripsi' => NULL,
                'created_at' => '2021-08-07 04:45:59',
                'updated_at' => '2021-08-07 04:45:59',
            ),
            26 => 
            array (
                'id' => '27',
                'name' => 'anggota.ubah',
                'guard_name' => 'web',
                'deskripsi' => NULL,
                'created_at' => '2021-08-12 04:09:42',
                'updated_at' => '2021-08-12 04:09:42',
            ),
            27 => 
            array (
                'id' => '28',
                'name' => 'anggota.detail',
                'guard_name' => 'web',
                'deskripsi' => NULL,
                'created_at' => '2021-08-12 04:15:22',
                'updated_at' => '2021-08-12 04:15:22',
            ),
        ));
        
        
    }
}