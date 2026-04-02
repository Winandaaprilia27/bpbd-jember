<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatKepangkatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawai_id',
        'riwayat_kepangkatan',
        'pejabat',
        'nomor',
        'tanggal',
        'tmt'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'tmt' => 'date',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}