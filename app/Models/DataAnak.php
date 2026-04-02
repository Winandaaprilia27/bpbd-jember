<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAnak extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawai_id',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'status',
        'dari_pasangan_ke',
        'jk',
        'status_kawin',
        'status_pekerjaan'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'dari_pasangan_ke' => 'integer',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}