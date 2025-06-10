<?php

namespace App\Http\Livewire\Admin\KelolaTahunAjar;

use App\Models\TahunAjar;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Table extends Component
{
    use Actions; // Mengimpor namespace Actions.
    use WithPagination; // Menggunakan fitur paginasi dalam komponen Livewire.

    // Properti untuk mengontrol tampilan modal edit
    public $editModal = false;
    public $idTahunAjar;
    public $tahunAjar;

    // Metode untuk menampilkan modal edit dengan mengisi data tahun ajaran yang akan diubah
    public function editModal($id)
    {
        // Ambil data tahun ajaran berdasarkan ID yang diberikan
        $getTahunAjar = TahunAjar::find($id);

        // Isi properti dengan data tahun ajaran yang akan diubah
        $this->idTahunAjar = $getTahunAjar->id_tahun_ajar;
        $this->tahunAjar = $getTahunAjar->tahun;

        // Tampilkan modal edit
        $this->editModal = true;
    }

    // Metode untuk menyimpan perubahan tahun ajaran ke database setelah dilakukan validasi
    public function updateTahunAjar($id)
    {
        // Lakukan validasi terhadap input tahun ajaran yang akan diubah
        $this->validate(
            ['tahunAjar' => 'required|unique:tahun_ajars,tahun,' . $id. ',id_tahun_ajar|regex:/^\d{4}\/\d{4}$/|different_year'],
            [
                'tahunAjar.required' => 'Tahun Ajar tidak boleh kosong.',
                'tahunAjar.unique' => 'Tahun Ajar sudah ada.',
                'tahunAjar.regex' => 'Format Tahun Ajar tidak sesuai.',
                'tahunAjar.different_year' => 'Tahun Ajar tidak boleh sama.',
            ]
        );

        // Ambil data tahun ajaran yang akan diubah berdasarkan ID
        $tahunAjar = TahunAjar::find($id);

        // Update data tahun ajaran dengan data baru
        $tahunAjar->update([
            'tahun' => $this->tahunAjar,
        ]);

        // Tutup modal edit setelah berhasil diubah
        $this->editModal = false;

        // Tampilkan notifikasi sukses
        $this->notification()->success(
            $title = 'Berhasil',
            $description = 'Berhasil Mengubah Tahun Ajar',
        );
    }

    // Metode untuk menampilkan konfirmasi hapus sebelum menghapus data tahun ajaran
    public function deleteConfirm($id)
    {
        $this->dialog()->confirm([
            'title'       => 'Apakah Kamu Yakin?',
            'description' => 'Dapus Data Ini?',
            'acceptLabel' => 'Ya, Hapus',
            'rejectLabel' => 'Tidak',
            'method'      => 'deleteTahunAjar',
            'params'      => $id,
        ]);
    }

    // Metode untuk menghapus data tahun ajaran dari database
    public function deleteTahunAjar($id)
    {
        // Ambil data tahun ajaran yang akan dihapus berdasarkan ID
        $tahunAjar = TahunAjar::find($id);

        // Hapus data tahun ajaran
        $tahunAjar->delete();

        // Tampilkan notifikasi sukses
        $this->notification()->success(
            $title = 'Berhasil',
            $description = 'Berhasil Menghapus Tahun Ajar',
        );
    }

    // Metode untuk menampilkan tabel data tahun ajaran dengan paginasi
    public function render()
    {
        // Ambil data tahun ajaran dengan paginasi 10 data per halaman
        return view('livewire.admin.kelola-tahun-ajar.table', [
            'dataTahunAjar' => TahunAjar::paginate(10),
        ]);
    }
}
