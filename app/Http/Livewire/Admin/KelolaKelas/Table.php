<?php

namespace App\Http\Livewire\Admin\KelolaKelas;

use App\Models\Kelas;
use App\Models\Prodi;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Table extends Component
{
    use Actions;
    use WithPagination;

    public $editModal = false;

    public $idKelas;
    public $namaKelas;

    public $dataProdi = [];
    public $prodi;

    protected $listeners = [
        'refresh' => '$refresh',
    ];

    public function editModal($id)
    {
        $this->dataProdi = Prodi::all();

        $kelas = Kelas::find($id);

        $this->idKelas = $kelas->id_kelas;
        $this->namaKelas = $kelas->nama_kelas;
        $this->prodi = $kelas->prodi_id;

        $this->editModal = true;
    }

    public function updateKelas($id)
    {
        $this->validate([
            'namaKelas' => 'required',
            'prodi' => 'required',
        ]);

        $kelas = Kelas::find($id);

        $kelas->update([
            'nama_kelas' => $this->namaKelas,
            'prodi_id' => $this->prodi,
        ]);

        $this->editModal = false;

        $this->notification()->success(
            $title = 'Berhasil',
            $description = 'Berhasil Mengubah Kelas',
        );
    }

    public function deleteConfirm($id)
    {
        $this->dialog()->confirm([
            'title'       => 'Apakah Kamu Yakin?',
            'description' => 'Dapus Data Ini?',
            'acceptLabel' => 'Ya, Hapus',
            'rejectLabel' => 'Tidak',
            'method'      => 'deleteKelas',
            'params'      => $id,
        ]);
    }

    public function deleteKelas($id)
    {
        $kelas = Kelas::find($id);

        $kelas->delete();

        $this->notification()->success(
            $title = 'Berhasil',
            $description = 'Berhasil Menghapus Kelas',
        );
    }
    
    public function render()
    {
        return view('livewire.admin.kelola-kelas.table', [
            'dataKelas' => Kelas::paginate(10),
        ]);
    }
}
