<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\KenaikanGaji;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;

class KenaikanGajiController extends Controller
{
    // Daftar gaji pokok berdasarkan pangkat/golongan dengan masa kerja
    private $gajiPokok = [
        // Golongan I
        'I/a' => ['gaji' => 1_560_800, 'masa_kerja_min' => 0, 'masa_kerja_max' => 2],
        'I/b' => ['gaji' => 1_704_500, 'masa_kerja_min' => 2, 'masa_kerja_max' => 4],
        'I/c' => ['gaji' => 1_776_600, 'masa_kerja_min' => 4, 'masa_kerja_max' => 6],
        'I/d' => ['gaji' => 1_851_800, 'masa_kerja_min' => 6, 'masa_kerja_max' => 8],
        
        // Golongan II
        'II/a' => ['gaji' => 2_022_200, 'masa_kerja_min' => 0, 'masa_kerja_max' => 2],
        'II/b' => ['gaji' => 2_102_600, 'masa_kerja_min' => 2, 'masa_kerja_max' => 4],
        'II/c' => ['gaji' => 2_187_000, 'masa_kerja_min' => 4, 'masa_kerja_max' => 6],
        'II/d' => ['gaji' => 2_275_500, 'masa_kerja_min' => 6, 'masa_kerja_max' => 8],
        
        // Golongan III
        'III/a' => ['gaji' => 2_579_400, 'masa_kerja_min' => 0, 'masa_kerja_max' => 2],
        'III/b' => ['gaji' => 2_688_500, 'masa_kerja_min' => 2, 'masa_kerja_max' => 4],
        'III/c' => ['gaji' => 2_802_100, 'masa_kerja_min' => 4, 'masa_kerja_max' => 6],
        'III/d' => ['gaji' => 2_920_800, 'masa_kerja_min' => 6, 'masa_kerja_max' => 8],
        
        // Golongan IV
        'IV/a' => ['gaji' => 3_044_300, 'masa_kerja_min' => 0, 'masa_kerja_max' => 2],
        'IV/b' => ['gaji' => 3_173_600, 'masa_kerja_min' => 2, 'masa_kerja_max' => 4],
        'IV/c' => ['gaji' => 3_308_300, 'masa_kerja_min' => 4, 'masa_kerja_max' => 6],
        'IV/d' => ['gaji' => 3_449_100, 'masa_kerja_min' => 6, 'masa_kerja_max' => 8],
        'IV/e' => ['gaji' => 3_596_300, 'masa_kerja_min' => 8, 'masa_kerja_max' => 10],
        
        // Nama Pangkat (alternatif)
        'Juru Muda' => ['gaji' => 1_560_800, 'masa_kerja_min' => 0, 'masa_kerja_max' => 2],
        'Juru Muda Tingkat I' => ['gaji' => 1_704_500, 'masa_kerja_min' => 2, 'masa_kerja_max' => 4],
        'Juru' => ['gaji' => 1_776_600, 'masa_kerja_min' => 4, 'masa_kerja_max' => 6],
        'Pengatur Muda' => ['gaji' => 2_022_200, 'masa_kerja_min' => 0, 'masa_kerja_max' => 2],
        'Pengatur Muda Tingkat I' => ['gaji' => 2_102_600, 'masa_kerja_min' => 2, 'masa_kerja_max' => 4],
        'Pengatur' => ['gaji' => 2_187_000, 'masa_kerja_min' => 4, 'masa_kerja_max' => 6],
        'Penata Muda' => ['gaji' => 2_579_400, 'masa_kerja_min' => 0, 'masa_kerja_max' => 2],
        'Penata Muda Tingkat I' => ['gaji' => 2_688_500, 'masa_kerja_min' => 2, 'masa_kerja_max' => 4],
        'Penata' => ['gaji' => 2_802_100, 'masa_kerja_min' => 4, 'masa_kerja_max' => 6],
        'Pembina' => ['gaji' => 3_044_300, 'masa_kerja_min' => 0, 'masa_kerja_max' => 2],
        'Pembina Tingkat I' => ['gaji' => 3_173_600, 'masa_kerja_min' => 2, 'masa_kerja_max' => 4],
        'Pembina Utama Muda' => ['gaji' => 3_308_300, 'masa_kerja_min' => 4, 'masa_kerja_max' => 6],
        'Pembina Utama Madya' => ['gaji' => 3_449_100, 'masa_kerja_min' => 6, 'masa_kerja_max' => 8],
        'Pembina Utama' => ['gaji' => 3_596_300, 'masa_kerja_min' => 8, 'masa_kerja_max' => 10],
    ];

    public function index()
    {
        $pegawais = Pegawai::where('status', 'aktif')
            ->where('tmt_berkala', '<=', Carbon::now()->addMonths(3))
            ->orderBy('tmt_berkala', 'asc')
            ->paginate(10);
        
        return view('kenaikan-gaji.index', compact('pegawais'));
    }

    public function hitung(Pegawai $pegawai)
    {
        // Hitung kenaikan berkala
        $tmt_lama = Carbon::parse($pegawai->tmt_berkala);
        $tmt_baru = $tmt_lama->copy()->addYears(2);
        $masa_kerja_baru = $pegawai->masa_kerja + 2;
        
        // Logika kenaikan pangkat (setiap 4 tahun atau sesuai masa kerja)
        $pangkat_baru = $this->getPangkatBerikutnya($pegawai->pangkat_terakhir, $pegawai->masa_kerja);
        
        // Hitung gaji lama dan baru
        $gaji_lama = $this->getGajiPokok($pegawai->pangkat_terakhir);
        $gaji_baru = $this->getGajiPokok($pangkat_baru);
        
        // PASTIKAN GAJI BARU LEBIH TINGGI DARI GAJI LAMA
        // Jika gaji baru tidak lebih tinggi, tambahkan kenaikan 7.5%
        if ($gaji_baru <= $gaji_lama) {
            $kenaikanPersen = 0.075; // 7.5% kenaikan minimal
            $gaji_baru = $gaji_lama * (1 + $kenaikanPersen);
            // Bulatkan ke kelipatan 1000
            $gaji_baru = ceil($gaji_baru / 1000) * 1000;
        }
        
        // Hitung tunjangan dengan mempertimbangkan status perkawinan dan jumlah anak
        $statusKawin = $pegawai->dataPasangan->count() > 0;
        $jumlahAnak = min($pegawai->dataAnak->count(), 3); // Maksimal 3 anak
        
        $tunjanganLama = $this->hitungTunjangan($gaji_lama, $statusKawin, $jumlahAnak);
        $tunjanganBaru = $this->hitungTunjangan($gaji_baru, $statusKawin, $jumlahAnak);
        
        // Hitung total
        $total_lama = $gaji_lama + array_sum($tunjanganLama);
        $total_baru = $gaji_baru + array_sum($tunjanganBaru);
        $kenaikan_gaji = $gaji_baru - $gaji_lama;
        $kenaikan_total = $total_baru - $total_lama;
        $persen_kenaikan = ($kenaikan_gaji / $gaji_lama) * 100;
        
        return view('kenaikan-gaji.hitung', compact(
            'pegawai', 
            'tmt_baru', 
            'masa_kerja_baru', 
            'pangkat_baru',
            'gaji_lama',
            'gaji_baru',
            'tunjanganLama',
            'tunjanganBaru',
            'total_lama',
            'total_baru',
            'kenaikan_gaji',
            'kenaikan_total',
            'persen_kenaikan',
            'statusKawin',
            'jumlahAnak'
        ));
    }
    
    public function simpan(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'tmt_berkala_baru' => 'required|date',
            'masa_kerja_baru' => 'required|integer',
            'pangkat_baru' => 'required',
            'nomor_sk' => 'required',
            'tanggal_sk' => 'required|date',
            'gaji_lama' => 'required|numeric',
            'gaji_baru' => 'required|numeric',
            'total_lama' => 'required|numeric',
            'total_baru' => 'required|numeric',
        ]);
        
        try {
            // Simpan data kenaikan gaji
            $kenaikanGaji = KenaikanGaji::create([
                'pegawai_id' => $pegawai->id,
                'tmt_berkala_lama' => $pegawai->tmt_berkala,
                'tmt_berkala_baru' => $request->tmt_berkala_baru,
                'masa_kerja_lama' => $pegawai->masa_kerja,
                'masa_kerja_baru' => $request->masa_kerja_baru,
                'pangkat_lama' => $pegawai->pangkat_terakhir,
                'pangkat_baru' => $request->pangkat_baru,
                'gaji_lama' => $request->gaji_lama,
                'gaji_baru' => $request->gaji_baru,
                'total_lama' => $request->total_lama,
                'total_baru' => $request->total_baru,
                'kenaikan_gaji' => $request->kenaikan_gaji,
                'kenaikan_total' => $request->kenaikan_total,
                'persen_kenaikan' => $request->persen_kenaikan,
                'nomor_sk' => $request->nomor_sk,
                'tanggal_sk' => $request->tanggal_sk,
                'status' => 'selesai'
            ]);
            
            // Update data pegawai
            $pegawai->update([
                'tmt_berkala' => $request->tmt_berkala_baru,
                'masa_kerja' => $request->masa_kerja_baru,
                'pangkat_terakhir' => $request->pangkat_baru
            ]);
            
            // Tambahkan riwayat kepangkatan baru
            $pegawai->riwayatKepangkatan()->create([
                'riwayat_kepangkatan' => $request->pangkat_baru,
                'pejabat' => 'Kepala BPBD Kab. Jember',
                'nomor' => $request->nomor_sk,
                'tanggal' => $request->tanggal_sk,
                'tmt' => $request->tmt_berkala_baru
            ]);
            
            return redirect()->route('kenaikan-gaji.cetak', $kenaikanGaji->id)
                ->with('success', 'Kenaikan gaji berkala berhasil diproses');
                
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
    
    public function cetak(KenaikanGaji $kenaikanGaji)
    {
        $kenaikanGaji->load('pegawai');
        
        // Hitung status perkawinan dan jumlah anak
        $statusKawin = $kenaikanGaji->pegawai->dataPasangan->count() > 0;
        $jumlahAnak = min($kenaikanGaji->pegawai->dataAnak->count(), 3);
        
        // Hitung tunjangan untuk ditampilkan
        $tunjanganLama = $this->hitungTunjangan($kenaikanGaji->gaji_lama, $statusKawin, $jumlahAnak);
        $tunjanganBaru = $this->hitungTunjangan($kenaikanGaji->gaji_baru, $statusKawin, $jumlahAnak);
        
        $pdf = PDF::loadView('kenaikan-gaji.cetak', compact('kenaikanGaji', 'tunjanganLama', 'tunjanganBaru', 'statusKawin', 'jumlahAnak'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('SK-kenaikan-gaji-' . $kenaikanGaji->pegawai->nip . '.pdf');
    }
    
    /**
     * Mendapatkan gaji pokok berdasarkan pangkat
     */
    private function getGajiPokok($pangkat)
    {
        if (isset($this->gajiPokok[$pangkat])) {
            return $this->gajiPokok[$pangkat]['gaji'];
        }
        return 2_500_000; // default jika tidak ditemukan
    }
    
    /**
     * Menghitung tunjangan berdasarkan gaji pokok, status kawin, dan jumlah anak
     */
    private function hitungTunjangan($gajiPokok, $statusKawin = true, $jumlahAnak = 1)
    {
        return [
            'istri_suami' => $statusKawin ? $gajiPokok * 0.10 : 0, // 10% untuk istri/suami
            'anak' => $jumlahAnak * ($gajiPokok * 0.02), // 2% per anak
            'fungsional' => $gajiPokok * 0.20, // 20% tunjangan fungsional
            'struktural' => $gajiPokok * 0.15, // 15% tunjangan struktural
            'pangan' => 150_000, // Tunjangan pangan tetap
            'transport' => 200_000, // Tunjangan transport tetap
            'kinerja' => $gajiPokok * 0.30, // 30% tunjangan kinerja
            'beras' => 50_000, // Tunjangan beras
            'listrik' => 100_000, // Tunjangan listrik
            'resiko' => $gajiPokok * 0.05, // 5% tunjangan resiko kerja
        ];
    }
    
    /**
     * Mendapatkan pangkat berikutnya berdasarkan masa kerja
     */
    private function getPangkatBerikutnya($pangkat_sekarang, $masa_kerja = 0)
    {
        // Urutan pangkat berdasarkan golongan
        $urutanPangkat = [
            'I/a', 'I/b', 'I/c', 'I/d',
            'II/a', 'II/b', 'II/c', 'II/d',
            'III/a', 'III/b', 'III/c', 'III/d',
            'IV/a', 'IV/b', 'IV/c', 'IV/d', 'IV/e'
        ];
        
        $urutanNamaPangkat = [
            'Juru Muda', 'Juru Muda Tingkat I', 'Juru',
            'Pengatur Muda', 'Pengatur Muda Tingkat I', 'Pengatur',
            'Penata Muda', 'Penata Muda Tingkat I', 'Penata',
            'Pembina', 'Pembina Tingkat I', 'Pembina Utama Muda',
            'Pembina Utama Madya', 'Pembina Utama'
        ];
        
        // Cek apakah pangkat dalam format golongan
        $index = array_search($pangkat_sekarang, $urutanPangkat);
        if ($index !== false && isset($urutanPangkat[$index + 1])) {
            // Kenaikan pangkat setiap 4 tahun
            if ($masa_kerja >= 4) {
                return $urutanPangkat[$index + 1];
            }
        }
        
        // Cek apakah pangkat dalam format nama
        $indexNama = array_search($pangkat_sekarang, $urutanNamaPangkat);
        if ($indexNama !== false && isset($urutanNamaPangkat[$indexNama + 1])) {
            if ($masa_kerja >= 4) {
                return $urutanNamaPangkat[$indexNama + 1];
            }
        }
        
        // Jika tidak naik pangkat, tetap gunakan pangkat yang sama
        return $pangkat_sekarang;
    }
}