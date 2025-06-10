<?php

namespace App\Http\Livewire\Pemilih;

use Livewire\Component;

class Dashboard extends Component
{
    public $tutorialModal = false;

    public function openModalTutorial(){
        $this->tutorialModal = true;
    }

    public function render()
    {
        return view('livewire.pemilih.dashboard');
    }


}
