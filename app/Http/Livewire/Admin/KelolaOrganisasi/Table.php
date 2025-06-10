<?php

namespace App\Http\Livewire\Admin\KelolaOrganisasi;

use Livewire\Component;
use App\Models\Organisasi;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Table extends Component
{
    use WithPagination;
    use Actions;

    protected $listeners = [
        'refresh' => '$refresh',
    ];

    public $editModal = false;
    public $organisasiId;
    public $namaOrganisasi;
    public $search;
    public $timeStart;
    public $timeEnd;
    public $active;

    public function editModal($id)
    {
        $this->organisasiId = $id;

        $organisasi = Organisasi::find($id);
        $this->namaOrganisasi = $organisasi->name;
        $this->active = $organisasi->active;
        $this->timeStart = date('Y-m-d\TH:i:s', strtotime($organisasi->start));
        $this->timeEnd = date('Y-m-d\TH:i:s', strtotime($organisasi->end));

        $this->editModal = true;
    }

    public function updateOrganisasi($id)
    {
        $this->validate([
            'namaOrganisasi' => 'required',
            'timeStart' => 'required',
            'timeEnd' => 'required'
        ]);

        $organisasi = Organisasi::find($id);

        $organisasi->update([
            'name' => $this->namaOrganisasi,
            'start' => date('Y-m-d H:i:s', strtotime($this->timeStart)),
            'end' => date('Y-m-d H:i:s', strtotime($this->timeEnd)),
        ]);

        $this->editModal = false;

        $this->notification()->success(
            $title = 'Berhasil',
            $description = 'Berhasil Mengubah Organisasi',
        );
    }

    public function deleteConfirm($id)
    {
        $this->dialog()->confirm([
            'title'       => 'Apakah Kamu Yakin?',
            'description' => 'Dapus Data Ini?',
            'acceptLabel' => 'Ya, Hapus',
            'rejectLabel' => 'Tidak',
            'method'      => 'deleteOrganisasi',
            'params'      => $id,
        ]);
    }

    public function deleteOrganisasi($id)
    {
        $organisasi = Organisasi::find($id);

        $organisasi->delete();

        $this->notification()->success(
            $title = 'Berhasil',
            $description = 'Berhasil Menghapus Organisasi',
        );
    }

    public function updatedActive()
    {
        $organisasi = Organisasi::find($this->organisasiId);

        $organisasi->update([
            'active' => $this->active,
        ]);

        $this->notification()->success(
            $title = 'Berhasil',
            $description = 'Berhasil Mengubah Status Organisasi',
        );
    }

    public function render()
    {
        $dataOrganisasi = Organisasi::query();

        if ($this->search != null) {
            $dataOrganisasi = $dataOrganisasi->where('name', 'like', '%' . $this->search . '%');
        }

        return view('livewire.admin.kelola-organisasi.table', [
            'dataOrganisasi' => $dataOrganisasi->paginate(10),
        ]);
    }
}
