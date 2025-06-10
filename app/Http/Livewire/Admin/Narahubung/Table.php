<?php

namespace App\Http\Livewire\Admin\Narahubung;

use Livewire\Component;
use App\Models\Narahubung;
use WireUi\Traits\Actions;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Table extends Component
{
    use WithPagination;
    use Actions;

    protected $listeners = [
        'refresh' => '$refresh',
    ];

    public function deleteConfirm($id)
    {
        $this->dialog()->confirm([
            'title'       => 'Apakah Kamu Yakin?',
            'description' => 'Dapus Data Ini?',
            'acceptLabel' => 'Ya, Hapus',
            'rejectLabel' => 'Tidak',
            'method'      => 'deleteNarahubung',
            'params'      => $id,
        ]);
    }

    public function deleteNarahubung($id)
    {
        $narahubung = Narahubung::find($id);

        $file = File::delete('storage/photos/' . $narahubung->image);

        $narahubung->delete();

        $this->notification()->success(
            $title = 'Berhasil',
            $description = 'Berhasil Menghapus Narahubung',
        );
    }

    public function render()
    {
        $narahubungs = Narahubung::latest()->paginate(10);

        return view('livewire.admin.narahubung.table', [
            'narahubungs' => $narahubungs
        ]);
    }
}
