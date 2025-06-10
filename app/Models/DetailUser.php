<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DetailUser extends Model
{
    use HasFactory;

    // Definsi table detail_users
    protected $table = 'detail_users';

    // Definisi key 
    protected $primaryKey = 'user_id';

    // Definsi set data untuk memasukkan kedalam database
    protected $fillable = [
        'user_id',
        'nama_pemilih',
        'kelas_id',
        'prodi_id',
        'tahun_ajar_id'
    ];

    // Methode untuk melakukan pemanggilan relasi kedalam Model Detail Users
    public function prodi(): HasOne
    {
        return $this->hasOne(Prodi::class, 'id_prodi', 'prodi_id');
    }

    // Methode untuk melakukan pemanggilan relasi kedalam Model Detail Users
    public function tahun_ajar(): HasOne
    {
        return $this->hasOne(TahunAjar::class, 'id_tahun_ajar', 'tahun_ajar_id');
    }
    
    // Methode untuk melakukan pemanggilan relasi kedalam Model Detail Users
    public function kelas(): HasOne
    {
        return $this->hasOne(Kelas::class, 'id_kelas', 'kelas_id');
    }
}
