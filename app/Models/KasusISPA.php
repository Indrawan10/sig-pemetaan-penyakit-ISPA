<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasusISPA extends Model
{
    use HasFactory;

    protected $table = 'kasus_ispa';
    protected $fillable = [
        'pemetaan_ispa_id',
        'nama_penyakit',
        'umur',
        'jumlah_laki_laki',
        'jumlah_perempuan'
    ];

    public function desa()
    {
        return $this->belongsTo(PemetaanISPA::class, 'pemetaan_ispa_id');
    }
}
