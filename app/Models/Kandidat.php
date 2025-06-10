<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kandidat extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'organisasi_id',
        'ketua',
        'wakil',
        'visi',
        'misi',
        'periode',
        'kelas_ketua_id',
        'kelas_wakil_id',
        'prodi_ketua_id',
        'prodi_wakil_id',
        'foto',
        'foto_ketua',
        'foto_wakil',
    ];

    public function organisasi()
    {
        return $this->hasOne(Organisasi::class, 'id', 'organisasi_id');
    }

    public function kelas_ketua()
    {
        return $this->hasOne(Kelas::class, 'id_kelas', 'kelas_ketua_id');
    }

    public function kelas_wakil()
    {
        return $this->hasOne(Kelas::class, 'id_kelas', 'kelas_wakil_id');
    }

    public function prodi_ketua()
    {
        return $this->hasOne(Prodi::class, 'id_prodi', 'prodi_ketua_id');
    }

    public function prodi_wakil()
    {
        return $this->hasOne(Prodi::class, 'id_prodi', 'prodi_wakil_id');
    }

    public function perolehanSuara()
    {
        return $this->hasMany(PerolehanSuara::class, 'kandidat_id', 'id');
    }
    
   

}
