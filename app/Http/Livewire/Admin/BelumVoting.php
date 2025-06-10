<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class BelumVoting extends Component
{
    public $tabs = 'chartPoll';

    public function switch($tab)
    {
        $this->tabs = $tab;
    }
    public function render()
    {
        return view('livewire.admin.belum-voting');
    }
}
