<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin')->delete();
        
        \DB::table('admin')->insert(array (
            0 => 
            array (
                'id' => '1',
                'nama' => 'Admin',
                'username' => 'admin',
                'password' => bcrypt('admin'),
                'jenis_kelamin' => '1',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        // beri role ke admin
        Admin::find(1)->assignRole('Admin');
    }
}