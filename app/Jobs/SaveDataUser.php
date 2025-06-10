<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Prodi;
use App\Models\TahunAjar;
use App\Models\DetailUser;
use Illuminate\Bus\Queueable;
use App\Notifications\SendDataUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Facades\Cookie;

class SaveDataUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $username;
    protected $email;
    protected $nama;
    protected $kelas;
    protected $prodi;
    protected $tahun;
    protected $password;

    public function __construct($username, $email, $nama, $kelas, $prodi, $tahun, $password)
    {
        $this->username = $username;
        $this->email = $email;
        $this->nama = $nama;
        $this->kelas = $kelas;
        $this->prodi = $prodi;
        $this->tahun = $tahun;
        $this->password = $password;
    }

    /**
     * Execute the job.
     */
    public function handle() :void
    {
        $check = User::where('email', $this->email)->orWhere('username', $this->username)->get();

        if ($this->username != null && $check->count() == 0) {
            try {
                $user = User::create([
                    'username' => $this->username,
                    'email' => $this->email,
                    'password' => Hash::make($this->password),
                ]);

                DetailUser::create([
                    'user_id' => $user->id,
                    'nama_pemilih' => $this->nama ?? null,
                    // 'kelas_id' => Kelas::where('nama_kelas', 'like', '%' . $this->kelas . '%')->first()->id_kelas ?? null,
                    // 'prodi_id' => Prodi::where('nama_prodi', 'like', '%' . $this->prodi . '%')->first()->id_prodi ?? null,
                    // 'tahun_ajar_id' => TahunAjar::where('tahun', 'like', '%' . $this->tahun . '%')->first()->id_tahun_ajar ?? null,
                ]);

                $user->assignRole('user');

                $user->notify(new SendDataUser($this->username, $this->password, $this->nama ?? ''));

                $value = session('successData');

                if ($value == null) {
                    session(['successData' => 1]);
                }else{
                    session(['successData' => $value + 1]);
                }
                $value = session('successData');

                logger()->info($value . ' Data user berhasil disimpan dengan email: ' . $this->email);

            } catch (\Throwable $th) {
                // logger()->error($this->email . ' gagal: ' . $th->getMessage());
                logger()->alert($this->email . ' gagal: ' . $th->getMessage());
                $user->delete();
            }
        }
    }
}
