<?php

namespace App\Http\Livewire\Admin\BelumVoting;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Prodi;
use Livewire\Component;
use App\Models\Kandidat;
use App\Models\TahunAjar;
use App\Models\Organisasi;
use Livewire\WithPagination;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class TablePoll extends Component
{
    use WithPagination;
    public $organisasi;
    public $tabOrganisasi;
    public $selectedKelas = '';
    public $selectedProdi = '';
    public $selectedTahunAjar = '';
    public $kelasList = [];
    public $prodiList = [];
    public $tahunAjarList = [];
    public $kandidatList = [];
    public $perPage = 10;

    public function mount()
    {
        $this->organisasi = Organisasi::has("kandidat")->where("active", true)
            ->select("id", "name")
            ->get();

        if (isset($this->organisasi->first()->id)) {
            $this->tabOrganisasi = $this->organisasi->first()->id;
            $this->loadFilterData();
        } else {
            $this->tabOrganisasi = null;
        }
    }

    public function select($id)
    {
        $this->tabOrganisasi = $id;
        $this->render();
    }

    public function loadFilterData()
    {
        // $this->kelasList = Kelas::select("id_kelas", "nama_kelas")->get();
        $this->prodiList = Prodi::select("id_prodi", "nama_prodi")->get();
        $this->tahunAjarList = TahunAjar::select("id_tahun_ajar", "tahun")->get();
        $this->kandidatList = Kandidat::select("id", "ketua", "wakil")->get();
    }

    public function loadMahasiswaBelumVoting()
    {
        $dataMahasiswaBelumVoting = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        })->whereDoesntHave('perolehanSuara', function ($q) {
            $q->whereHas('kandidat', function ($subQ) {
                $subQ->where('organisasi_id', $this->tabOrganisasi);
            });
        })->with(['detail_pengguna.kelas', 'detail_pengguna.prodi', 'detail_pengguna.tahun_ajar']);

        // filter
        if ($this->selectedKelas) {
            $dataMahasiswaBelumVoting->whereHas('detail_pengguna', function ($q) {
                $q->where('kelas_id', $this->selectedKelas);
            });
        }

        if ($this->selectedProdi) {
            $dataMahasiswaBelumVoting->whereHas('detail_pengguna', function ($q) {
                $q->where('prodi_id', $this->selectedProdi);
            });
        }

        if ($this->selectedTahunAjar) {
            $dataMahasiswaBelumVoting->whereHas('detail_pengguna', function ($q) {
                $q->where('tahun_ajar_id', $this->selectedTahunAjar);
            });
        }

        return $dataMahasiswaBelumVoting->paginate($this->perPage);
    }


    // public function updatedSelectedKelas()
    // {
    //     $this->resetPage();
    //     $this->loadMahasiswaBelumVoting();
    // }

    public function updatedSelectedProdi()
    {
        $this->resetPage();
        $this->selectedKelas = '';
        $this->updateKelasList();
        $this->loadMahasiswaBelumVoting();
    }

    // public function updatedSelectedTahunAjar()
    // {
    //     $this->resetPage();
    //     $this->loadMahasiswaBelumVoting();
    // }

    public function updateKelasList()
    {
        if ($this->selectedProdi) {
            $this->kelasList = Kelas::select('id_kelas', 'nama_kelas')
                ->where('prodi_id', $this->selectedProdi)
                ->get();
        } else {
            // kosongin list kelas
            $this->kelasList = collect();
        }
    }

    public function resetFilters()
    {
        $this->selectedKelas = '';
        $this->selectedProdi = '';
        $this->selectedTahunAjar = '';
        $this->resetPage();
        $this->loadMahasiswaBelumVoting();
    }

    public function render()
    {
        $dataOrganisasi = Organisasi::where('id', $this->tabOrganisasi)->first();
        $organisasiName = $dataOrganisasi ? $dataOrganisasi->name : '';

        return view('livewire.admin.belum-voting.table-poll', [
            'organisasiName' => $organisasiName,
            'mahasiswaBelumVoting' => $this->loadMahasiswaBelumVoting()
        ]);
    }

        public function exportExcel()
    {
        // Membuat spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Menambahkan data ke dalam spreadsheet
        $sheet->setCellValue('A1', 'nim');
        $sheet->setCellValue('B1', 'nama_pemilih');
        $sheet->setCellValue('C1', 'email');
        $sheet->setCellValue('D1', 'Kelas');
        $sheet->setCellValue('E1', 'Prodi');
        $sheet->setCellValue('F1', 'Tahun Ajaran');

        // Mengambil data pengguna (users) beserta detail_pengguna yang telah di-eager load.
        $users = User::role('user')->with('detail_pengguna')->get();

        // Menentukan baris awal untuk memulai penulisan data di file Excel.
        $row = 2;

        // Melakukan iterasi pada setiap pengguna (user).
        foreach ($users as $user) {
            // Menuliskan data username pada kolom A dan baris yang sesuai.
            $sheet->setCellValue('A' . $row, $user->nim);

            // Menuliskan data email pada kolom B dan baris yang sesuai.
            $sheet->setCellValue('B' . $row, $user->email);

            // Menuliskan data nama_kelas pada kolom C dan baris yang sesuai.
            // Jika detail_pengguna atau kelas kosong, maka akan dituliskan string kosong ('').
            $sheet->setCellValue('C' . $row, isset($user->detail_pengguna->nama_pemilih) ? $user->detail_pengguna->nama_pemilih : '');

            $sheet->setCellValue('D' . $row, isset($user->detail_pengguna->kelas) ? $user->detail_pengguna->kelas->nama_kelas : '');

            // Menuliskan data nama_prodi pada kolom D dan baris yang sesuai.
            // Jika detail_pengguna atau prodi kosong, maka akan dituliskan string kosong ('').
            $sheet->setCellValue('E' . $row, isset($user->detail_pengguna->prodi) ? $user->detail_pengguna->prodi->nama_prodi : '');

            // Menuliskan data tahun pada kolom E dan baris yang sesuai.
            // Jika detail_pengguna atau tahun_ajar kosong, maka akan dituliskan string kosong ('').
            $sheet->setCellValue('F' . $row, isset($user->detail_pengguna->tahun_ajar) ? $user->detail_pengguna->tahun_ajar->tahun : '');

            // Pindah ke baris selanjutnya untuk menuliskan data pengguna berikutnya.
            $row++;
        }


        // Menyimpan spreadsheet ke file sementara
        $writer = new Xlsx($spreadsheet);
        $tempFile = tempnam(sys_get_temp_dir(), 'export');
        $writer->save($tempFile);

        // Mengembalikan file sebagai respons unduhan
        return response()
            ->download($tempFile, 'Pengguna Pemira ' . Carbon::now()->format('Y-m-d H:i:s') . '.xlsx')
            ->deleteFileAfterSend();
    }
}
