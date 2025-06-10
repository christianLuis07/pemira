<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    // Definsi type data pada primary key = string
    protected $keyType = 'string';

    // Definsi table prodi
    protected $table = 'kelas';

    // Definsi primary key
    protected $primaryKey = 'id_kelas';

    // Definisi tidak menggunakan timestamps
    public $timestamps = false;

    protected $fillable = [
        'id_kelas',
        'prodi_id',
        'nama_kelas'
    ];
}
