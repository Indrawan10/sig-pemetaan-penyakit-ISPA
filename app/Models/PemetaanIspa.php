<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemetaanIspa extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_desa',
        'jumlah_terkena',
        'latitude',
        'longitude',
        'marker_color',
        'address'
    ];

    public function penduduk()
    {
        return $this->hasMany(Penduduk::class, 'pemetaan_ispa_id');
    }
}
