<?php

namespace App\Http\Livewire\Admin;

use Throwable;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Prodi;
use Livewire\Component;
use App\Models\TahunAjar;
use App\Models\DetailUser;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use App\Jobs\UploadUserExel;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use App\Notifications\SendDataUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class KelolaUser extends Component
{
    use Actions; // Mengimpor namespace Actions.
    use WithPagination; // Menggunakan fitur paginasi dalam komponen Livewire.
    use WithFileUploads;

    protected $listeners = [
        'refresh' => '$refresh',
    ];
    // Daftar "listener" yang telah didefinisikan. Jika event 'refresh' dipanggil, maka halaman akan direfresh.

    public $addUserModal = false;
    public $deleteUserModal = false;
    public $editUserModal = false;
    public $importExel = false;
    // Variabel untuk mengontrol muncul atau tidaknya modal tambah user dan modal edit user.

    public $nim;
    public $email;
    public $password;
    // Variabel untuk menyimpan nilai nim, email, dan password yang akan ditambahkan saat menambah user baru.

    public $userId = 1;
    public $editnim;
    public $editEmail;
    public $editPassword;
    // Variabel untuk menyimpan nilai ID user yang akan diedit, serta nilai nim, email, dan password yang akan diubah saat mengedit user.

    public $search;
    // Variabel untuk menyimpan nilai kata kunci pencarian.

    public $role = 'user';
    // Variabel untuk menyimpan nilai peran user saat menambahkan user baru (default: 'user').

    public $dataKelas;
    public $dataProdi;
    public $dataTahunAjar;
    // Variabel untuk menyimpan data kelas, program studi, dan tahun ajar yang akan digunakan dalam komponen.

    public $idKelas;
    public $idProdi;
    public $idTahunAjar;
    // Variabel untuk menyimpan ID kelas, program studi, dan tahun ajar yang akan digunakan dalam proses tambah/edit user.

    public $name;
    // Variabel untuk menyimpan nilai nama (tidak jelas tujuannya, mungkin digunakan di bagian kode yang tidak tercantum di sini).
    public $fileExelUpload;

    // Membuat fungsi addUserModal
    public function addUserModal()
    {
        // Membuat modal / popup menjadi tampil pada halaman
        $this->addUserModal = true;
    }

    // Membuat fungsi menambahkan User
    public function saveAddUser()
    {

        // Menentukan aturan validasi untuk setiap input yang ada dalam request.
        $this->validate([
            'nim' => 'required|max:9|unique:users,nim',
            'email' => 'required|email'
        ], [
            // Memberikan pesan kustom untuk setiap aturan validasi yang telah ditentukan
            'nim.required' => 'Masukkan nim / nim terlebih dahulu.',
            'nim.unique' => 'nim sudah digunakan, silakan gunakan nim lain.',

            'email.required' => 'Masukkan alamat email terlebih dahulu.',
            'email.email' => 'Masukkan alamat email yang valid.',

            'password.required' => 'Masukkan password terlebih dahulu.',
            // Tambahkan pesan kustom lain di sini sesuai kebutuhan
        ]);

        $password = Str::random(8);

        $user = User::create([
            // 'id' => $newId,
            'nim' => $this->nim,
            'email' => $this->email,
            'password' => Hash::make($password),
        ]);

        // Membuat data DetailUser baru dengan mengisi 'user_id' dengan ID baru yang telah dibuat sebelumnya.
        DetailUser::create([
            'user_id' => $user->id
        ]);

        // Menugaskan role 'user' ke user yang sedang dibuat
        $user->assignRole('user');

        $user->notify(new SendDataUser($this->nim, $password, ''));
        logger()->info('Akun dengan Email ' . $user->email . ' berhasil dibuat, password: ' . $password);

        // Memeriksa apakah user berhasil dibuat sebelum menampilkan notifikasi berhasil
        if ($user) {
            $this->notification()->success(
                $title = 'Berhasil',
                $description = 'Berhasil Menambahkan User',
            );
        }

        // Membersihkan data masukan setelah user berhasil dibuat
        $this->nim = '';
        $this->email = '';
        $this->password = '';

        // Menutup modal tambah user setelah proses pembuatan user selesai
        $this->addUserModal = false;
    }

    public function editUserModal($id)
    {
        // Mengambil data pengguna berdasarkan ID.
        $user = User::find($id);

        // Mengisi variabel-variabel dengan data dari pengguna yang akan diedit.
        $this->userId       = $user->id;
        $this->editnim = $user->nim;
        $this->editEmail    = $user->email;
        $this->name         = $user->detail_pengguna->nama_pemilih ?? null;
        $this->idKelas      = $user->detail_pengguna->kelas_id ?? null;
        $this->idProdi      = $user->detail_pengguna->prodi_id ?? null;
        $this->idTahunAjar  = $user->detail_pengguna->tahun_ajar_id ?? null;

        // Mengambil data kelas, program studi (prodi), dan tahun ajaran dari database.
        $this->dataProdi = Prodi::all();
        $this->dataKelas = Kelas::where('prodi_id', $this->idProdi)->get() ?? [];
        $this->dataTahunAjar = TahunAjar::all();

        // Menampilkan modal untuk mengedit data pengguna.
        $this->editUserModal = true;
    }

    public function updatedIdProdi()
    {
        $this->dataKelas = Kelas::where('prodi_id', $this->idProdi)->get() ?? [];
    }

    public function saveUpdateUser($id)
    {
        // Validasi input data dari form sebelum melakukan penyimpanan atau pembaruan.
        // Validasi field 'editnim' harus wajib diisi dan harus unik (tidak ada duplikasi) dalam tabel 'users' kecuali untuk ID saat ini ($id).
        // Validasi field 'editEmail' harus wajib diisi dan harus merupakan format alamat email yang valid.
        // Selain itu, email harus unik (tidak ada duplikasi) dalam tabel 'users' kecuali untuk ID saat ini ($id).
        $this->validate([
            'editnim' => 'required|max:9|unique:users,nim,' . $id,
            'editEmail' => 'required|email|unique:users,email,' . $id,
        ]);

        // Cari pengguna berdasarkan ID yang diberikan.
        $user = User::find($id);

        // Siapkan data yang akan diupdate untuk pengguna.
        $data = [
            'nim' => $this->editnim,
            'email' => $this->editEmail,
        ];

        // Jika password baru (editPassword) diisi, maka tambahkan data password yang telah di-hash ke dalam data yang akan diupdate.
        if ($this->editPassword != null) {
            $data['password'] = Hash::make($this->editPassword);
        }

        // Lakukan pembaruan data pengguna dengan data yang telah disiapkan.
        $user->update($data);

        // Cari data DetailUser berdasarkan user_id yang diberikan.
        $dataUser = DetailUser::where('user_id', $id)->first();

        // Jika data DetailUser ditemukan, lakukan pembaruan data tersebut dengan data yang diberikan.
        if ($dataUser) {
            $dataUser->update([
                'user_id' => $id,
                'nama_pemilih' => $this->name ?? null,
                'kelas_id' => $this->idKelas ?? null,
                'prodi_id' => $this->idProdi ?? null,
                'tahun_ajar_id' => $this->idTahunAjar ?? null,
            ]);
        } else {
            // Jika data DetailUser tidak ditemukan, buat data baru dengan data yang diberikan.
            DetailUser::create([
                'user_id' => $id,
                'nama_pemilih' => $this->name ?? null,
                'kelas_id' => $this->idKelas ?? null,
                'prodi_id' => $this->idProdi ?? null,
                'tahun_ajar_id' => $this->idTahunAjar ?? null,
            ]);
        }

        // Jika pengguna berhasil diupdate, tampilkan notifikasi berhasil.
        if ($user) {
            $this->notification()->success(
                $title = 'Berhasil',
                $description = 'Berhasil Mengedit User',
            );
        }

        // Setel ulang nilai dari variabel yang digunakan dalam form.
        $this->editnim = '';
        $this->editEmail = '';
        $this->editPassword = '';

        // Tutup modal edit user.
        $this->editUserModal = false;
    }

    /**
     * Menampilkan konfirmasi untuk menghapus data user berdasarkan ID.
     *
     * @param int $id ID dari user yang akan dihapus.
     */
    public function deleteConfirm($id)
    {
        $this->dialog()->confirm([
            'title'       => 'Apakah Kamu Yakin?',
            'description' => 'Hapus Data User Ini?',
            'acceptLabel' => 'Ya, Hapus',
            'rejectLabel' => 'Tidak',
            'method'      => 'deleteUser',
            'params'      => $id,
        ]);
    }

    /**
     * Menghapus data user berdasarkan ID, termasuk data yang terkait seperti DetailUser.
     *
     * @param int $id ID dari user yang akan dihapus.
     */
    public function deleteUser($id)
    {
        // Mencari data DetailUser berdasarkan ID dan menghapusnya
        $detailUser = DetailUser::find($id);
        $detailUser->delete();

        // Mencari data User berdasarkan ID dan menghapusnya
        $user = User::find($id);
        $user->delete();

        // Memberikan notifikasi sukses jika data User berhasil dihapus
        if ($user) {
            $this->notification()->success(
                $title = 'Berhasil',
                $description = 'Berhasil Menghapus User',
            );
        }
    }


    public function exportExcel()
    {
        // Membuat spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Menambahkan data ke dalam spreadsheet
        $sheet->setCellValue('A1', 'nim');
        $sheet->setCellValue('B1', 'Email');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Kelas');
        $sheet->setCellValue('E1', 'Prodi');
        $sheet->setCellValue('F1', 'Tahun Ajaran');

        // Mengambil data pengguna (users) beserta detail_pengguna yang telah di-eager load.
        $users = User::role('user')->with('detail_pengguna')->get();

        // Menentukan baris awal untuk memulai penulisan data di file Excel.
        $row = 2;

        // Melakukan iterasi pada setiap pengguna (user).
        foreach ($users as $user) {
            // Menuliskan data nim pada kolom A dan baris yang sesuai.
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

    public function importExel()
    {
        $this->importExel = true;
    }

    public function uploadExel()
    {
        $this->importExel = false;

        $this->validate([
            'fileExelUpload' => 'required|mimes:xlsx'
        ]);

        try {
            $uploadDataUser = UploadUserExel::dispatch($this->fileExelUpload->getRealPath())->onQueue('uploadUser');

            // $value = session('successData');

            $this->dialog()->success(
                $title = 'Berhasil!!!',
                $description = 'Berhasil mengunggah data user'
            );
            // if ($uploadDataUser == true) {
            // } else {
            //     $this->dialog()->error(
            //         $title = 'Error !!!',
            //         $description = 'Gagal mengunggah file exel, data yg diunggah '. $value
            //     );
            // }

        } catch (Throwable $e) {
            logger()->error($e->getMessage());

            $this->notification()->error(
                $title = 'Gagal',
                $description = 'Gagal mengunggah file exel',
            );
        }

        $this->reset('fileExelUpload');
        request()->session()->forget('successData');
    }

    public function sendEmail($id)
    {
        try {
            $user = User::find($id);
            $password = Str::random(8);

            $user->update([
                'password' => Hash::make($password),
            ]);

            $user->notify(new SendDataUser($user->nim, $password, ''));

            $this->notification()->success(
                $title = 'Berhasil',
                $description = 'Berhasil mengirim email',
            );
            logger()->info('Email sudah dikirim ke ' . $user->email . ' dengan password: ' . $password);
        } catch (Throwable $e) {
            logger()->error($e->getMessage());

            $this->notification()->error(
                $title = 'Gagal',
                $description = 'Gagal mengirim email',
            );
        }
    }

    public function deleteAllUserConfirm()
    {
        $this->dialog()->confirm([
            'title'       => 'Apakah Kamu Yakin?',
            'description' => 'Hapus Semua Data User Ini?',
            'acceptLabel' => 'Ya, Hapus',
            'rejectLabel' => 'Tidak',
            'method'      => 'deleteAllUser',
        ]);
    }

    public function deleteAllUser()
    {
        $users = User::role('user')->get();

        foreach ($users as $user) {
            $user->delete();
        }

        $this->notification()->success(
            $title = 'Berhasil',
            $description = 'Berhasil Menghapus Semua User',
        );
    }

    public function render()
    {
        // Mengambil semua nama roles dari model Role dan menyimpannya dalam variabel $roles
        $roles = Role::all()->pluck('name');

        // Mengambil data User beserta relasi detail_pengguna berdasarkan role yang diberikan
        $dataUser = User::with('detail_pengguna')->role($this->role);

        // Jika terdapat data pada kolom pencarian ($this->search), maka lakukan filter pada dataUser
        if ($this->search != null) {
            $dataUser->where('nim', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orWhereHas('detail_pengguna', function ($query) {
                    // Mengambil data relasi detail_pengguna beserta relasinya (kelas, prodi, tahun_ajar)
                    $query->with('kelas', 'prodi', 'tahun_ajar')
                        // Melakukan pencarian berdasarkan nama_pemilih yang sesuai dengan kolom pencarian ($this->search)
                        ->where('nama_pemilih', 'like', '%' . $this->search . '%')
                        ->orWhereHas('prodi', function ($query) {
                            // Melakukan pencarian berdasarkan nama_prodi yang sesuai dengan kolom pencarian ($this->search)
                            $query->where('nama_prodi', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('tahun_ajar', function ($query) {
                            // Melakukan pencarian berdasarkan tahun yang sesuai dengan kolom pencarian ($this->search)
                            $query->where('tahun', 'like', '%' . $this->search . '%');
                        });
                });
        }

        // Mengirim dataUser yang sudah difilter dan data roles ke halaman 'livewire.admin.kelola-user' dengan batasan 10 data per halaman (paginate)
        return view('livewire.admin.kelola-user', [
            'dataUser' => $dataUser->paginate(10),
            'roles' => $roles,
        ]);
    }
}
