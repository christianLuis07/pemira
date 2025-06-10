<?php

namespace App\Http\Livewire\Admin\KelolaKandidat;

use App\Models\Kelas;
use App\Models\Prodi;
use Livewire\Component;
use App\Models\Kandidat;
use App\Models\Organisasi;
use WireUi\Traits\Actions;
use Livewire\WithFileUploads;

class AddKandidat extends Component
{
    use Actions;
    use WithFileUploads;

    public $addKandidat = false;
    public $namaKetua;
    public $kelasKetua;
    public $prodiKetua;
    public $namaWakil;
    public $kelasWakil;
    public $prodiWakil;
    public $visi;
    public $misi;
    public $foto;
    public $fotoKetua;
    public $fotoWakil;
    public $periode;
    public $organisasi;
    public $dataKelas;
    public $dataProdi;
    public $dataOrganisasi;


    public function addKandidat()
    {
        $this->dataKelas = Kelas::all();
        $this->dataProdi = Prodi::all();
        $this->dataOrganisasi = Organisasi::all();

        $this->addKandidat = true;
    }

    public function save()
    {
        // Validasi kandidat
        $this->validate([
            'namaKetua' => 'required',
            'kelasKetua' => 'required',
            'prodiKetua' => 'required',
            'namaWakil' => 'required',
            'kelasWakil' => 'required',
            'prodiWakil' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:1024',
            'fotoKetua' => 'required|image|mimes:jpg,jpeg,png|max:1024',
            'fotoWakil' => 'required|image|mimes:jpg,jpeg,png|max:1024',
            'periode' => 'required',
            'organisasi' => 'required',
        ]);

        //Penyimpanan foto
        $this->foto->store('photos', 'public');
        $this->fotoKetua->store('photos', 'public');
        $this->fotoWakil->store('photos', 'public');

        //Menyimpan kedalam database
        $kandidat = Kandidat::create([
            'organisasi_id' => $this->organisasi,
            'ketua' => $this->namaKetua,
            'wakil' => $this->namaWakil,
            'visi' => $this->visi,
            'misi' => $this->misi,
            'periode' => $this->periode,
            'kelas_ketua_id' => $this->kelasKetua,
            'kelas_wakil_id' => $this->kelasWakil,
            'prodi_ketua_id' => $this->prodiKetua,
            'prodi_wakil_id' => $this->prodiWakil,
            'foto' => $this->foto->hashName(),
            'foto_ketua' => $this->fotoKetua->hashName(),
            'foto_wakil' => $this->fotoWakil->hashName(),
        ]);

        if ($kandidat) {
            // Menghapus file foto sementara
            $fotos = ['foto', 'fotoKetua', 'fotoWakil'];
            foreach ($fotos as $foto) {
                if (isset($this->$foto)) {
                    $this->$foto->delete();
                    $this->reset($foto);
                }
            }

            // Reset input form
            $this->reset('namaKetua');
            $this->reset('kelasKetua');
            $this->reset('prodiKetua');
            $this->reset('namaWakil');
            $this->reset('kelasWakil');
            $this->reset('prodiWakil');
            $this->reset('periode');
            $this->reset('organisasi');

            $this->emit('refresh');

            $this->addKandidat = false;

            $this->notification()->success(
                $title = 'Berhasil',
                $description = 'Berhasil Menambahkan Kandidat',
            );
        }
    }


    public function render()
    {
        return view('livewire.admin.kelola-kandidat.add-kandidat');
    }
}
