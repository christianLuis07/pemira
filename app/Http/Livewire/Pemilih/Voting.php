<?php

namespace App\Http\Livewire\Pemilih;

use Livewire\Component;
use App\Models\Kandidat;
use App\Models\Organisasi;
use App\Models\PerolehanSuara;
use WireUi\Traits\Actions;

class Voting extends Component
{
    use Actions;
    public $openModal = false;

    public $kandidatId;
    public $organisasiId;
    public $ketua;
    public $wakil;
    public $visi;
    public $misi;
    public $foto;
    public $periode;
    public $kelasKetua;
    public $prodiKetua;
    public $kelasWakil;
    public $prodiWakil;

    public function openModal($kandidatId, $organisasiId)
    {
        $this->kandidatId = $kandidatId;
        $this->organisasiId = $organisasiId;

        $kandidat = Kandidat::find($kandidatId);
        $this->ketua = $kandidat->ketua;
        $this->wakil = $kandidat->wakil;
        $this->visi = $kandidat->visi;
        $this->misi = $kandidat->misi;
        $this->foto = $kandidat->foto;
        $this->periode = $kandidat->periode;
        $this->kelasKetua = $kandidat->kelas_ketua->nama_kelas;
        $this->prodiKetua = $kandidat->prodi_ketua->nama_prodi;
        $this->kelasWakil = $kandidat->kelas_wakil->nama_kelas;
        $this->prodiWakil = $kandidat->prodi_wakil->nama_prodi;

        $this->openModal = true;
    }

    public function vote()
    {
        $updateSuara = PerolehanSuara::create([
            'user_id' => auth()->user()->id,
            'organisasi_id' => $this->organisasiId,
            'kandidat_id' => $this->kandidatId,
        ]);

        if ($updateSuara) {
            $this->dialog()->success(
                $title = 'Berhasil Memilih',
                $description = 'Terimakasih telah menggunakan hak pilih anda'
            );
        } else {
            $this->dialog()->error(
                $title = 'Maaf',
                $description = ''
            );
        }

        $this->openModal = false;
    }

    public function render()
    {
        $organisasi = Organisasi::has('kandidat')
            ->where('active', true)
            ->where('start', '<=', now())
            ->where('end', '>=', now())
            ->get();
        return view('livewire.pemilih.voting', [
            'dataOrganisasi' => $organisasi,
        ]);

    }
}
