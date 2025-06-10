<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Kandidat;
use App\Models\KandidKandidat;
use App\Models\Kelas;
use App\Models\Organisasi;
use App\Models\Prodi;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use WireUi\Traits\Actions;


class KelolaKandidat extends Component
{
    use WithPagination; // Menggunakan fitur paginasi dalam komponen Livewire.
    use Actions; // Mengimpor namespace Actions.
    use WithFileUploads; // Menggunakan fitur upload file dalam komponen Livewire.
    public $addKandidat = false;
    public $editKandidat = false;
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
    public $kandidatId;

    // Daftar "listener" yang telah didefinisikan. Jika event 'refresh' dipanggil, maka halaman akan direfresh.
    protected $listeners = [
        'refresh' => '$refresh',
    ];
    public $search;

    // Menampilkan dialog konfirmasi sebelum menghapus data kandidat.
    public function deleteConfirm($id)
    {
        $this->dialog()->confirm([
            'title'       => 'Apakah Kamu Yakin?',
            'description' => 'Hapus Data Ini?',
            'acceptLabel' => 'Ya, Hapus',
            'rejectLabel' => 'Tidak',
            'method'      => 'deleteKandidat',
            'params'      => $id,
        ]);
    }

    //menghandle dialog hasil konfirmasi voting
    public function deleteKandidat($id)
    {
        try {//jika ya maka akan menampilkan notifikasi Berhasil menghapus kandidat
            $kandidat = Kandidat::findOrFail($id);
            $fotoPaths = [
                public_path('storage/photos/' . $kandidat->foto),
                public_path('storage/photos/' . $kandidat->foto_ketua),
                public_path('storage/photos/' . $kandidat->foto_wakil),
            ];
            foreach ($fotoPaths as $fotoPath) {
                if (File::exists($fotoPath)) {
                    File::delete($fotoPath);
                }
            }
            $kandidat->delete();

            $this->notification()->success(
                $title = 'Berhasil',
                $description = 'Berhasil Menghapus Kandidat',
            );
        } catch (\Exception $e) {// jika tidak Kandidat ini sudah divoting, sebaiknya kosongkan voting terlebih dahulu
            $this->notification()->error(
                $title = 'Gagal',
                $description = 'Kandidat ini sudah divoting, sebaiknya kosongkan voting terlebih dahulu',
            );
        }
    }

    public function editKandidat($id)
    {
        // Ambil data kelas, prodi, dan organisasi dari database
        $this->dataKelas = Kelas::all();
        $this->dataProdi = Prodi::all();
        $this->dataOrganisasi = Organisasi::all();

        // Ambil data kandidat dari database menggunakan model "Kandidat"
        $kandidat = Kandidat::find($id); // ID kandidat yang ingin diambil

        // Isi data dari database ke variabel komponen Livewire
        $this->kandidatId = $id;
        $this->namaKetua = $kandidat->ketua;
        $this->kelasKetua = $kandidat->kelas_ketua_id;
        $this->prodiKetua = $kandidat->prodi_ketua_id;
        $this->namaWakil = $kandidat->wakil;
        $this->kelasWakil = $kandidat->kelas_wakil_id;
        $this->prodiWakil = $kandidat->prodi_wakil_id;
        $this->visi = $kandidat->visi;
        $this->misi = $kandidat->misi;
        $this->foto = $kandidat->foto;
        $this->fotoKetua = $kandidat->foto_ketua;
        $this->fotoWakil = $kandidat->foto_wakil;
        $this->periode = $kandidat->periode;
        $this->organisasi = $kandidat->organisasi_id;

        $this->editKandidat = true;
    }

    public function saveUpdateKandidat($id)
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
            'periode' => 'required',
            'organisasi' => 'required',
        ]);

        // Penyimpanan foto

        $fotos = ['foto', 'fotoKetua', 'fotoWakil'];
        foreach ($fotos as $foto) {
            if (!is_string($this->$foto)) {
                $this->validate([
                    $foto => 'required|image|mimes:jpg,jpeg,png|max:1024',
                ]);

                $this->$foto->store('photos', 'public');
            }
        }

        // Fetch existing Kandidat or create a new instance
        $kandidat = Kandidat::find($id);

        // Update attributes using array association
        $kandidat->update([
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
            'foto' => is_string($this->foto) ? $this->foto : $this->foto->hashName(),
            'foto_ketua' => is_string($this->fotoKetua) ? $this->fotoKetua : $this->fotoKetua->hashName(),
            'foto_wakil' => is_string($this->fotoWakil) ? $this->fotoWakil : $this->fotoWakil->hashName(),
        ]);

        if ($kandidat) {
            // Menghapus file foto sementara
            $fotos = ['foto', 'fotoKetua', 'fotoWakil'];
            foreach ($fotos as $foto) {
                if (isset($this->$foto) && !is_string($this->$foto)) {
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
            $this->reset('foto');
            $this->reset('fotoWakil');
            $this->reset('fotoKetua');


            $this->editKandidat = false;

            $this->emit('refresh');

            $this->notification()->success(
                $title = 'Berhasil',
                $description = 'Berhasil Update Kandidat',
            );
        }
    }



    public function render()
    {
        $dataKandidat = Kandidat::query();

        // Jika ada kata kunci pencarian ($this->search), maka lakukan filtrasi data
        if ($this->search != null) {
            // Gunakan WHERE dengan operator LIKE untuk mencari data kandidat yang nama ketua atau wakilnya mengandung kata kunci pencarian
            $dataKandidat = $dataKandidat->where('ketua', 'like', '%' . $this->search . '%')
                ->orWhere('wakil', 'like', '%' . $this->search . '%');
        }

        // Setelah data difilter (jika ada pencarian), kirim data kandidat ke halaman 'livewire.admin.kelola-kandidat' dengan menggunakan paginasi 10 data per halaman.
        return view('livewire.admin.kelola-kandidat', [
            'dataKandidat' => $dataKandidat->paginate(10),
        ]);
    }
}
