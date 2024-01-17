<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //user seeders
        collect([
            [
                'divisi_id' => 3,
                'nama' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'Admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'divisi_id' => 1,
                'nama' => 'Jono',
                'email' => 'jono@gmail.com',
                'password' => Hash::make('jono123'),
                'role' => 'Karyawan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'divisi_id' => 3,
                'nama' => 'SuperAdmin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('super123'),
                'role' => 'SuperAdmin',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ])->each(function ($users){
            User::insert($users);
        });
    }
}
