<?php

namespace App\Http\Livewire\Admin;

use App\Models\Kelas;
use App\Models\Prodi;
use Livewire\Component;
use WireUi\Traits\Actions;

class KelolaKelas extends Component
{
    use Actions;
    public $nama;
    public $prodi;

    public function simpan()
    {
        $lastKelas = Kelas::orderBy('id_kelas', 'desc')->first();

        // Jika ada data program studi terakhir, ambil angka berikutnya dari id_Kelas terakhir
        // dan hapus huruf 'K' pada awalnya, lalu tambahkan 1
        $nextCodeNumber = $lastKelas ? ((int) substr($lastKelas->id_kelas, 1) + 1) : 1;

        // Format kode Kelas dengan tiga digit, contoh: K001
        $newKodeKelas = 'K' . str_pad($nextCodeNumber, 3, '0', STR_PAD_LEFT);

        $this->validate([
            'nama' => 'required',
            'prodi' => 'required',
        ]);
        // dd($this->prodi);
        $addKelas = Kelas::create([
            'id_kelas' => $newKodeKelas,
            'prodi_id' => $this->prodi,
            'nama_kelas' => $this->nama,
        ]);

        if($addKelas){
            $this->notification()->success(
                $title = 'Berhasil',
                $description = 'Berhasil Menambah Kelas',
            );

            $this->emit('refresh');
        }else{
            $this->notification()->error(
                $title = 'Gagal',
                $description = 'Gagal Menambah Kelas',
            );
        }
    }

    public function render()
    {
        $dataProdi = Prodi::all();
        
        return view('livewire.admin.kelola-kelas', [
            'dataProdi' => $dataProdi,
        ]);
    }
}
