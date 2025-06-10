<?php

namespace App\Http\Livewire\Admin\HasilVoting;

use Livewire\Component;
use App\Models\Organisasi;

class TablePoll extends Component
{
    public $dataOrganisasi;

    public function mount()
    {
        $this->dataOrganisasi = Organisasi::has('kandidat')
        ->where('active', true)
        // ->where('start', '<=', now())
        // ->where('end', '>=', now())
        ->with(['kandidat' => function ($query) {
            $query->withCount('perolehanSuara');
        }])->withCount('perolehanSuara as perolehanSuaraTotal')->get();// Hitung total perolehanSuara untuk setiap organisasi
    }

    public function counter()
    {
        $this->mount();
    }

    public function render()
    {
        return view('livewire.admin.hasil-voting.table-poll');
    }
}
