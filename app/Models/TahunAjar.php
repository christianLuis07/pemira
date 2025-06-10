<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjar extends Model
{
    use HasFactory;

    // Definsi type data pada primary key = string
    protected $keyType = 'string';

    // Definsi table tahun ajar
    protected $table = 'tahun_ajars';

    // Definisi primary key
    protected $primaryKey = 'id_tahun_ajar';

    // Definisi tidak menggunakan timestamps
    public $timestamps = false;

    protected $fillable =[
        'id_tahun_ajar',
        'tahun'
    ];
}
