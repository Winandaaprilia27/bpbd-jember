<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPendidikan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawai_id',
        'jenjang',
        'sekolah',
        'tahun_lulus'
    ];

    protected $casts = [
        'tahun_lulus' => 'integer',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}