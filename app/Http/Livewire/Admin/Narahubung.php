<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Narahubung as ModelNarahubung;
use WireUi\Traits\Actions;
use Livewire\WithFileUploads;

class Narahubung extends Component
{
    use WithFileUploads;
    use Actions;

    public $name;
    public $description;
    public $phone;
    public $photo;

    public function saveNarahubung()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'phone' => 'required',
            'photo' => 'required|image|max:2048'
        ]);

        $this->photo->store('photos', 'public');

        ModelNarahubung::create([
            'name' => $this->name,
            'description' => $this->description,
            'phone' => $this->phone,
            'image' => $this->photo->hashName()
        ]);

        $this->reset();
        $this->emit('refresh');

        $this->notification()->success(
            $title = 'Berhasil',
            $description = 'Berhasil Menambahkan Narahubung',
        );
    }

    public function render()
    {
        return view('livewire.admin.narahubung');
    }
}
