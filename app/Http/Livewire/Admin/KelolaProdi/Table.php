<?php

namespace App\Http\Livewire\Admin\KelolaProdi;

use App\Models\Prodi;
use Livewire\Component;
use WireUi\Traits\Actions;
use Livewire\WithPagination;

class Table extends Component
{
    use Actions; // Mengimpor namespace Actions.
    use WithPagination; // Menggunakan fitur paginasi dalam komponen Livewire.
    public $editModal = false;// Properti untuk mengontrol tampilan modal edit
    public $idProdi;
    public $namaProdi;
    public $search;


    // Metode untuk menampilkan modal edit dengan mengisi data program studi yang akan diubah
    public function editModal($id)
    {
        // Ambil data program studi berdasarkan ID yang diberikan
        $prodi = Prodi::find($id);

        // Isi properti dengan data program studi yang akan diubah
        $this->idProdi = $prodi->id_prodi;
        $this->namaProdi = $prodi->nama_prodi;

        // Tampilkan modal edit
        $this->editModal = true;
    }

    // Metode untuk menyimpan perubahan program studi ke database setelah dilakukan validasi
    public function updateProdi($id)
    {
        // Lakukan validasi terhadap input nama program studi yang akan diubah
        $this->validate([
            'namaProdi' => 'required',
        ]);

        // Ambil data program studi yang akan diubah berdasarkan ID
        $prodi = Prodi::find($id);

        // Update data program studi dengan data baru
        $prodi->update([
            'nama_prodi' => $this->namaProdi,
        ]);

        // Tutup modal edit setelah berhasil diubah
        $this->editModal = false;

        // Tampilkan notifikasi sukses
        $this->notification()->success(
            $title = 'Berhasil',
            $description = 'Berhasil Mengubah Prodi',
        );
    }

    // Metode untuk menampilkan konfirmasi hapus sebelum menghapus data program studi
    public function deleteConfirm($id)
    {
        $this->dialog()->confirm([
            'title'       => 'Apakah Kamu Yakin?',
            'description' => 'Dapus Data Ini?',
            'acceptLabel' => 'Ya, Hapus',
            'rejectLabel' => 'Tidak',
            'method'      => 'deleteProdi',
            'params'      => $id,
        ]);
    }

    
    public function deleteProdi($id)
    {
        $prodi = Prodi::find($id);        // Ambil data program studi yang akan dihapus berdasarkan ID

        // Hapus data program studi
        $prodi->delete();

        $this->notification()->success(
            $title = 'Berhasil',
            $description = 'Berhasil Menghapus Prodi',
        );
    }

    // Metode untuk menampilkan tabel data program studi dengan paginasi
    public function render()
    {
        // Ambil data program studi dengan paginasi 10 data per halaman
        $dataProdi = Prodi::query();

        // Lakukan filtrasi data berdasarkan kata kunci pencarian (jika ada)
        if ($this->search !== null) {
            $dataProdi = $dataProdi->where('nama_prodi', 'like', '%' . $this->search . '%');
        }

        return view('livewire.admin.kelola-prodi.table', [
            'dataProdi' => $dataProdi->paginate(10),
        ]);
    }

}
