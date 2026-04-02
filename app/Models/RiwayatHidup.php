<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatHidup extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawai_id',
        'nomor_dokumen',
        'tanggal_dibuat',
        'file_path',
        'status'
    ];

    protected $casts = [
        'tanggal_dibuat' => 'date',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}