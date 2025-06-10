<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerolehanSuara extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'organisasi_id',
        'kandidat_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class);
    }

    public function kandidat()
    {
        return $this->belongsTo(Kandidat::class);
    }
}
