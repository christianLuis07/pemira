<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $detailAdminUser = \App\Models\DetailUser::create([
            'user_id' => '1',
            'nama_pemilih' => 'Admin User',
            'kelas_id' => null,
            'prodi_id' => null,
            'tahun_ajar_id' => null,
        ]);

        $detailRegularUser = \App\Models\DetailUser::create([
            'user_id' => '2',
            'nama_pemilih' => 'Regular User',
            'kelas_id' => "K001",
            'prodi_id' => "P001",
            'tahun_ajar_id' => "TA001",
        ]);
    }
}
