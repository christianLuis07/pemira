<?php

namespace App\Http\Livewire\Pemilih;

use App\Models\Kandidat;
use App\Models\Organisasi;
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
        return view('livewire.pemilih.hasil-voting');
    }
}
