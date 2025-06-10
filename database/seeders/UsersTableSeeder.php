<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Prodi;
use App\Models\TahunAjar;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // Membuat pengguna Admin
                $adminUser = \App\Models\User::create([
                    'email' => 'admin@example.com',
                    'password' => Hash::make('12345678') // Ubah 'password' dengan password yang Anda inginkan
                ]);

                // Membuat pengguna Biasa
                $regularUser = \App\Models\User::create([
                    'nim' => '230102083',
                    'email' => 'user@example.com',
                    'password' => Hash::make('12345678') // Ubah 'password' dengan password yang Anda inginkan
                ]);

                // Membuat peran Admin
                $adminRole = Role::create(['name' => 'admin']);

                // Membuat peran Pengguna Biasa
                $regularUserRole = Role::create(['name' => 'user']);

                // Membuat izin, misalnya 'edit articles'
                $adminPermission = Permission::create(['name' => 'admin access']);

                // Memberikan izin 'edit articles' kepada peran Admin
                $adminRole->givePermissionTo($adminPermission);

                // Memberikan peran Admin kepada pengguna Admin
                $adminUser->assignRole('admin');

                // Memberikan peran Pengguna Biasa kepada pengguna Biasa
                $regularUser->assignRole('user');

                $tahunAjar = TahunAjar::create([
                    'id_tahun_ajar' => 'TA001',
                    'tahun' => '2020/2021'
                ]);

                $prodi = Prodi::create([
                    'id_prodi' => 'P001',
                    'nama_prodi' => 'Teknik Informatika',
                ]);

                $kelas = Kelas::create([
                    'id_kelas' => 'K001',
                    'nama_kelas' => 'TI-1A'
                ]);


    }
}
