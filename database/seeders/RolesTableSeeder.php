<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => '1',
                'name' => 'Admin',
                'guard_name' => 'web',
                'deskripsi' => 'Punya akses ke sumua',
                'created_at' => '2021-08-07 06:40:37',
                'updated_at' => '2021-08-07 06:40:37',
            ),
            1 => 
            array (
                'id' => '2',
                'name' => 'Operator',
                'guard_name' => 'web',
                'deskripsi' => 'Akses seprti Admin kecuali akses ke Anggota',
                'created_at' => '2021-08-07 04:58:59',
                'updated_at' => '2021-08-07 04:58:59',
            ),
            2 => 
            array (
                'id' => '3',
                'name' => 'Pendata',
                'guard_name' => 'web',
                'deskripsi' => 'Hanya punya akses ke Pandataan',
                'created_at' => '2021-08-12 02:46:44',
                'updated_at' => '2021-08-12 02:46:44',
            ),
        ));
        
        // berim ijin admin
        Role::find(1)->givePermissionTo([
            "buku_tahun.daftar",
            "buku_tahun.detail",
            "buku_tahun.tambah",
            "buku_tahun.hapus",
            "buku_tahun.tahun_aktif",
            "buku_tahun.tagihan",
            "pendataan.daftar",
            "pendataan.tagihan",
            "pendataan.tagihan_ubah",
            "pelanggan.daftar",
            "pelanggan.detail",
            "pelanggan.hapus",
            "pelanggan.tambah",
            "pelanggan.ubah",
            "pelanggan.print",
            "pelanggan.tagihan",
            "pelanggan.tagihan_bayar",
            "desa.daftar",
            "desa.detail",
            "desa.tambah",
            "desa.ubah",
            "desa.hapus",
            "anggota.daftar",
            "anggota.tambah",
            "anggota.hapus",
            "anggota.ubah",
            "anggota.detail",
        ]);

        // ijin opertator
        Role::find(2)->givePermissionTo([
            "buku_tahun.daftar",
            "buku_tahun.detail",
            "buku_tahun.tambah",
            "buku_tahun.hapus",
            "buku_tahun.tahun_aktif",
            "buku_tahun.tagihan",
            "pendataan.daftar",
            "pendataan.tagihan",
            "pendataan.tagihan_ubah",
            "pelanggan.daftar",
            "pelanggan.detail",
            "pelanggan.hapus",
            "pelanggan.tambah",
            "pelanggan.ubah",
            "pelanggan.print",
            "pelanggan.tagihan",
            "pelanggan.tagihan_bayar",
            "desa.daftar",
            "desa.detail",
            "desa.tambah",
            "desa.ubah",
            "desa.hapus",
        ]);

        // ijin pendata
        Role::find(3)->givePermissionTo([
            "pendataan.daftar",
            "pendataan.tagihan",
            "pendataan.tagihan_ubah",
        ]);
    }
}