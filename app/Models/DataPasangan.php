<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPasangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawai_id',
        'suami_istri',
        'tempat_lahir',
        'tanggal_lahir',
        'pekerjaan',
        'instansi',
        'urutan'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'urutan' => 'integer',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}