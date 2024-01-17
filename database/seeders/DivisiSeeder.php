<?php

namespace Database\Seeders;

use App\Models\Divisi;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //divisi seeders
        collect([
            [
                'nama_divisi' => 'Riset dan Teknologi',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_divisi' => 'Hubungan Publik',
                'status' => 'Nonaktif',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_divisi' => 'Administrator',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ])->each(function ($divisis){
                Divisi::insert($divisis);
        });
    }
}
