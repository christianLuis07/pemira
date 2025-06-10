<?php

namespace App\Http\Livewire\Admin;

use App\Models\Kandidat;
use App\Models\Organisasi;
use App\Models\PerolehanSuara;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $countUser = User::where('id', '<>', 1)->count();
        $countKandidat = Kandidat::count();
        $countOrganisasi = Organisasi::count();
        return view('livewire.admin.dashboard',[
            'countUser' => $countUser,
            'countKandidat' => $countKandidat,
            'countOrganisasi' => $countOrganisasi
        ]);
    }
}
