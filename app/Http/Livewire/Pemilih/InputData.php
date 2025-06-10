<?php

namespace App\Http\Livewire\Pemilih;

use App\Models\Kelas;
use App\Models\Prodi;
use App\Models\TahunAjar;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class InputData extends Component
{
    public $dataKelas;
    public $dataProdi;
    public $dataTahunAjar;
    public $nama;
    public $password;
    public $password_confirmation;
    public $kelas;
    public $prodi;
    public $tahunAjar;

    public function mount()
    {
        $this->nama = Auth::user()->detail_pengguna->nama_pemilih ?? null;
        $this->kelas = Auth::user()->detail_pengguna->kelas_id ?? null;
        $this->prodi = Auth::user()->detail_pengguna->prodi_id ?? null;
        $this->tahunAjar = Auth::user()->detail_pengguna->tahun_ajar_id ?? null;
    }

    public function save()
    {
        // Validasi data
        $this->validate([
            'nama' => 'required',
            // 'password' => 'required|min:8|confirmed',
            'kelas' => 'required',
            'prodi' => 'required',
            'tahunAjar' => 'required',
        ]);

        // Mencari data sesuai authenticate
        $user = User::find(Auth::id());
        // $user->update([
        //     'password' => Hash::make($this->password),
        // ]);

        $user->detail_pengguna()->updateOrCreate([
            'user_id' => $user->id,
        ], [
            'nama_pemilih' => $this->nama,
            'kelas_id' => $this->kelas,
            'prodi_id' => $this->prodi,
            'tahun_ajar_id' => $this->tahunAjar,
        ]);

        return redirect()->route('pemilih.dashboard');
    }

    public function render()
    {
        $this->dataProdi = Prodi::all();
        $this->dataKelas = Kelas::where('prodi_id', $this->prodi)->get() ?? [];
        $this->dataTahunAjar = TahunAjar::all();

        return view('livewire.pemilih.input-data');
    }
}
