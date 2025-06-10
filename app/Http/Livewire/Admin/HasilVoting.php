<?php

namespace App\Http\Livewire\Admin;

use App\Models\Kandidat;
use App\Models\Organisasi;
use App\Models\PerolehanSuara;
use Livewire\Component;

class HasilVoting extends Component
{

    public $tabs = 'chartPoll';

    public function switch($tab)
    {
        $this->tabs = $tab;
    }

    public function render()
    {
        return view('livewire.admin.hasil-voting');
    }
}
