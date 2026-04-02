<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KenaikanGaji extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawai_id',
        'tmt_berkala_lama',
        'tmt_berkala_baru',
        'masa_kerja_lama',
        'masa_kerja_baru',
        'pangkat_lama',
        'pangkat_baru',
        'gaji_lama',
        'gaji_baru',
        'total_lama',
        'total_baru',
        'kenaikan_gaji',
        'kenaikan_total',
        'persen_kenaikan',
        'nomor_sk',
        'tanggal_sk',
        'status'
    ];

    protected $casts = [
        'tmt_berkala_lama' => 'date',
        'tmt_berkala_baru' => 'date',
        'tanggal_sk' => 'date',
        'gaji_lama' => 'decimal:2',
        'gaji_baru' => 'decimal:2',
        'total_lama' => 'decimal:2',
        'total_baru' => 'decimal:2',
        'kenaikan_gaji' => 'decimal:2',
        'kenaikan_total' => 'decimal:2',
        'persen_kenaikan' => 'decimal:2',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    /**
     * Accessor untuk format gaji lama dalam Rupiah
     */
    public function getGajiLamaFormattedAttribute()
    {
        return 'Rp ' . number_format($this->gaji_lama, 0, ',', '.');
    }

    /**
     * Accessor untuk format gaji baru dalam Rupiah
     */
    public function getGajiBaruFormattedAttribute()
    {
        return 'Rp ' . number_format($this->gaji_baru, 0, ',', '.');
    }

    /**
     * Accessor untuk format kenaikan gaji dalam Rupiah
     */
    public function getKenaikanGajiFormattedAttribute()
    {
        return 'Rp ' . number_format($this->kenaikan_gaji, 0, ',', '.');
    }

    /**
     * Accessor untuk format total lama dalam Rupiah
     */
    public function getTotalLamaFormattedAttribute()
    {
        return 'Rp ' . number_format($this->total_lama, 0, ',', '.');
    }

    /**
     * Accessor untuk format total baru dalam Rupiah
     */
    public function getTotalBaruFormattedAttribute()
    {
        return 'Rp ' . number_format($this->total_baru, 0, ',', '.');
    }

    /**
     * Accessor untuk format kenaikan total dalam Rupiah
     */
    public function getKenaikanTotalFormattedAttribute()
    {
        return 'Rp ' . number_format($this->kenaikan_total, 0, ',', '.');
    }

    /**
     * Accessor untuk format persentase kenaikan
     */
    public function getPersenKenaikanFormattedAttribute()
    {
        return number_format($this->persen_kenaikan, 2) . '%';
    }

    /**
     * Accessor untuk TMT Berkala Lama yang diformat
     */
    public function getTmtBerkalaLamaFormattedAttribute()
    {
        return $this->tmt_berkala_lama ? $this->tmt_berkala_lama->format('d-m-Y') : '-';
    }

    /**
     * Accessor untuk TMT Berkala Baru yang diformat
     */
    public function getTmtBerkalaBaruFormattedAttribute()
    {
        return $this->tmt_berkala_baru ? $this->tmt_berkala_baru->format('d-m-Y') : '-';
    }

    /**
     * Accessor untuk Tanggal SK yang diformat
     */
    public function getTanggalSkFormattedAttribute()
    {
        return $this->tanggal_sk ? $this->tanggal_sk->format('d-m-Y') : '-';
    }

    /**
     * Accessor untuk status dengan badge HTML
     */
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'proses' => '<span class="badge bg-warning">Proses</span>',
            'selesai' => '<span class="badge bg-success">Selesai</span>',
            'batal' => '<span class="badge bg-danger">Batal</span>',
        ];
        
        return $badges[$this->status] ?? '<span class="badge bg-secondary">' . ucfirst($this->status) . '</span>';
    }

    /**
     * Scope untuk query data yang sudah selesai
     */
    public function scopeSelesai($query)
    {
        return $query->where('status', 'selesai');
    }

    /**
     * Scope untuk query data yang masih proses
     */
    public function scopeProses($query)
    {
        return $query->where('status', 'proses');
    }

    /**
     * Scope untuk query berdasarkan periode
     */
    public function scopePeriode($query, $tahun)
    {
        return $query->whereYear('tmt_berkala_baru', $tahun);
    }

    /**
     * Mendapatkan selisih kenaikan dalam persen
     */
    public function getSelisihKenaikanAttribute()
    {
        return $this->kenaikan_gaji;
    }

    /**
     * Mendapatkan total penghasilan setelah kenaikan
     */
    public function getTotalPenghasilanBaruAttribute()
    {
        return $this->total_baru;
    }

    /**
     * Mendapatkan informasi lengkap kenaikan
     */
    public function getInfoKenaikanAttribute()
    {
        return [
            'gaji_lama' => $this->gaji_lama_formatted,
            'gaji_baru' => $this->gaji_baru_formatted,
            'kenaikan' => $this->kenaikan_gaji_formatted,
            'persen' => $this->persen_kenaikan_formatted,
            'total_lama' => $this->total_lama_formatted,
            'total_baru' => $this->total_baru_formatted,
            'kenaikan_total' => $this->kenaikan_total_formatted,
        ];
    }
}