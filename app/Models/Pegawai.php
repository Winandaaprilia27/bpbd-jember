<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'nip', 'foto', 'tempat_lahir', 'tanggal_lahir', 'jk', 'agama',
        'alamat', 'email', 'hp', 'pangkat_terakhir', 'jabatan_terakhir',
        'unit_kerja', 'pendidikan', 'prodi', 'sk_cpns', 'sk_pns',
        'masa_kerja', 'tmt_berkala', 'tmt_pensiun', 'status'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tmt_berkala' => 'date',
        'tmt_pensiun' => 'date',
        'masa_kerja' => 'integer',
    ];

    // Accessor untuk URL foto
    public function getFotoUrlAttribute()
    {
        if ($this->foto && file_exists(storage_path('app/public/foto/' . $this->foto))) {
            return asset('storage/foto/' . $this->foto);
        }
        return asset('images/default-avatar.png');
    }

    // Relasi one-to-many
    public function riwayatPendidikan()
    {
        return $this->hasMany(RiwayatPendidikan::class);
    }

    public function riwayatKepangkatan()
    {
        return $this->hasMany(RiwayatKepangkatan::class);
    }

    public function riwayatJabatan()
    {
        return $this->hasMany(RiwayatJabatan::class);
    }

    public function dataPasangan()
    {
        return $this->hasMany(DataPasangan::class);
    }

    public function dataAnak()
    {
        return $this->hasMany(DataAnak::class);
    }

    public function kenaikanGaji()
    {
        return $this->hasMany(KenaikanGaji::class);
    }

    // Accessor untuk umur
    public function getUmurAttribute()
    {
        return $this->tanggal_lahir->age;
    }

    // Accessor untuk format tanggal
    public function getTanggalLahirFormattedAttribute()
    {
        return $this->tanggal_lahir->format('d-m-Y');
    }

    public function getTmtBerkalaFormattedAttribute()
    {
        return $this->tmt_berkala->format('d-m-Y');
    }

    public function getTmtPensiunFormattedAttribute()
    {
        return $this->tmt_pensiun->format('d-m-Y');
    }
}