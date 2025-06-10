<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    use HasFactory;

    // protected $keyType = 'string';


    protected $fillable = [
        'name',
        'start',
        'end',
        'active'
    ];

    public function kandidat()
    {
        return $this->hasMany(Kandidat::class);
    }

    public function perolehanSuara()
    {
        return $this->hasMany(PerolehanSuara::class);
    }
    public function perolehanSuaraTotal()
    {
        return $this->hasMany(PerolehanSuara::class, 'organisasi_id', 'id');
    }
}
