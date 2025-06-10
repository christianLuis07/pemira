<?php

namespace App\Http\Livewire\Admin;

use App\Models\Prodi;
use Livewire\Component;
use WireUi\Traits\Actions;
use Livewire\WithPagination;

class KelolaProdi extends Component
{
    use Actions; // Mengimpor namespace Actions.
    use WithPagination; // Menggunakan fitur paginasi dalam komponen Livewire.
    
    protected $listeners = [
        // Daftar "listener" yang telah didefinisikan. Jika event 'refresh' dipanggil, maka halaman akan direfresh.
        'refresh' => '$refresh',
    ];

    public function render()
    {

        // Mendapatkan data program studi terakhir berdasarkan id_prodi secara descending
        $lastProdi = Prodi::orderBy('id_prodi', 'desc')->first();

        // Jika ada data program studi terakhir, ambil angka berikutnya dari id_prodi terakhir
        // dan hapus huruf 'P' pada awalnya, lalu tambahkan 1
        $nextCodeNumber = $lastProdi ? ((int) substr($lastProdi->id_prodi, 1) + 1) : 1;

        // Format kode prodi dengan tiga digit, contoh: P001
        $newKodeProdi = 'P' . str_pad($nextCodeNumber, 3, '0', STR_PAD_LEFT);


        // Mengirim data program studi dan kode program studi baru ke view 'admin.kelola-prodi.index'
        return view('livewire.admin.kelola-prodi', [
            'newKodeProdi' => $newKodeProdi
        ]);
    }
}
