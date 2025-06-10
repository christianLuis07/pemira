<?php

namespace App\Http\Livewire\Admin;

use App\Models\Organisasi;
use Livewire\Component;
use WireUi\Traits\Actions;

class KelolaOrganisasi extends Component
{
    use Actions;

    public $namaOrganisasi;
    public $timeStart;
    public $timeEnd;

    public function saveOrganisasi()
    {
        // Validasi input nama organisasi
        $this->validate([
            'namaOrganisasi' => 'required:unique:organisasis,name',
            'timeStart' => 'required',
            'timeEnd' => 'required'
        ]);

        // dd($this->namaOrganisasi, $this->timeStart, $this->timeEnd);

        // Buat dan simpan data organisasi baru ke database
        $organisasi = Organisasi::create([
            'name' => $this->namaOrganisasi,
            'start' => date('Y-m-d H:i:s', strtotime($this->timeStart)),
            'end' => date('Y-m-d H:i:s', strtotime($this->timeEnd)),
            'active' => true
        ]);

        // Jika penyimpanan berhasil
        if ($organisasi){
            // Reset input nama organisasi menjadi kosong
            $this->reset('namaOrganisasi', 'timeStart', 'timeEnd');

            // Emit event 'refresh' untuk memperbarui data pada halaman yang menggunakan komponen ini
            $this->emit('refresh');

            // Tampilkan notifikasi sukses
            $this->notification()->success(
                $title = 'Berhasil',
                $description = 'Berhasil Menambahkan Organisasi',
            );
        }
    }

    public function render()
    {
        // Tampilkan halaman 'livewire.admin.kelola-organisasi'
        return view('livewire.admin.kelola-organisasi');
    }
}
