<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    // Definsi type data pada primary key = string
    protected $keyType = 'string';
    
    // Definsi table prodi
    protected $table = 'prodis';

    // Definsi primary key
    protected $primaryKey = 'id_prodi';

    protected $fillable = [
        'id_prodi',
        'nama_prodi'
    ];
}
