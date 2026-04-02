<!DOCTYPE html>
<html>
<head>
    <title>SK Kenaikan Gaji Berkala - {{ $kenaikanGaji->pegawai->nama }}</title>
    <style>
        body { 
            font-family: 'Times New Roman', Times, serif; 
            margin: 20px;
            font-size: 12pt;
        }
        .header { 
            text-align: center; 
            margin-bottom: 30px; 
        }
        .title { 
            font-size: 18px; 
            font-weight: bold; 
            text-transform: uppercase;
        }
        .subtitle { 
            font-size: 14px; 
        }
        .content { 
            margin-top: 30px; 
        }
        .sk-number { 
            text-align: center; 
            font-size: 16px; 
            font-weight: bold; 
            margin: 30px 0;
            line-height: 1.5;
        }
        .table-data { 
            width: 100%; 
            border-collapse: collapse; 
            margin: 20px 0; 
        }
        .table-data td { 
            padding: 10px 8px; 
            border-bottom: 1px solid #ddd;
        }
        .table-gaji {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .table-gaji th, .table-gaji td {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
        }
        .table-gaji th {
            background-color: #f2f2f2;
            text-align: center;
        }
        .table-gaji td {
            text-align: right;
        }
        .signature { 
            margin-top: 50px; 
        }
        .signature table {
            width: 100%;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .text-bold {
            font-weight: bold;
        }
        .garis-bawah {
            border-bottom: 1px solid #000;
        }
        .total {
            font-weight: bold;
            background-color: #f9f9f9;
        }
        hr {
            margin: 15px 0;
        }
        .keterangan {
            font-size: 10pt;
            margin-top: 20px;
            font-style: italic;
        }
        @media print {
            body {
                margin: 0;
                padding: 15px;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">PEMERINTAH KABUPATEN JEMBER</div>
        <div class="title">BADAN PENANGGULANGAN BENCANA DAERAH</div>
        <div class="subtitle">Jl. Jawa No. 35, Jember, Jawa Timur 68121</div>
        <div class="subtitle">Telp. (0331) 123456, Fax. (0331) 123456, Email: bpbd@jemberkab.go.id</div>
        <hr>
    </div>
    
    <div class="sk-number">
        KEPUTUSAN<br>
        KEPALA BADAN PENANGGULANGAN BENCANA DAERAH<br>
        KABUPATEN JEMBER<br>
        NOMOR: {{ $kenaikanGaji->nomor_sk }}<br>
        TENTANG<br>
        KENAIKAN GAJI BERKALA<br>
        PEGAWAI NEGERI SIPIL
    </div>
    
    <div class="content">
        <p>KEPALA BADAN PENANGGULANGAN BENCANA DAERAH KABUPATEN JEMBER,</p>
        
        <p><strong>Menimbang</strong> : bahwa untuk memberikan penghargaan dan meningkatkan kesejahteraan Pegawai Negeri Sipil, perlu menetapkan Keputusan tentang Kenaikan Gaji Berkala;</p>
        
        <p><strong>Mengingat</strong> :</p>
        <ol style="margin-left: 20px;">
            <li>Undang-Undang Nomor 5 Tahun 2014 tentang Aparatur Sipil Negara;</li>
            <li>Peraturan Pemerintah Nomor 11 Tahun 2017 tentang Manajemen Pegawai Negeri Sipil;</li>
            <li>Peraturan Pemerintah Nomor 15 Tahun 2019 tentang Perubahan Kedua atas Peraturan Pemerintah Nomor 7 Tahun 1977 tentang Peraturan Gaji Pegawai Negeri Sipil;</li>
            <li>Peraturan Bupati Jember Nomor 12 Tahun 2023 tentang Gaji Pokok Pegawai Negeri Sipil di Lingkungan Pemerintah Kabupaten Jember.</li>
        </ol>
        
        <p><strong>MEMUTUSKAN :</strong></p>
        
        <p><strong>Menetapkan</strong> : KENAIKAN GAJI BERKALA PEGAWAI NEGERI SIPIL</p>
        
        <!-- Data Pegawai -->
        <table class="table-data">
            <tr>
                <td width="200"><strong>Nama</strong></td>
                <td>: {{ $kenaikanGaji->pegawai->nama }}</td>
            </tr>
            <tr>
                <td><strong>NIP</strong></td>
                <td>: {{ $kenaikanGaji->pegawai->nip }}</td>
            </tr>
            <tr>
                <td><strong>Pangkat/Golongan</strong></td>
                <td>: {{ $kenaikanGaji->pangkat_baru }}</td>
            </tr>
            <tr>
                <td><strong>Jabatan</strong></td>
                <td>: {{ $kenaikanGaji->pegawai->jabatan_terakhir }}</td>
            </tr>
            <tr>
                <td><strong>Unit Kerja</strong></td>
                <td>: {{ $kenaikanGaji->pegawai->unit_kerja }}</td>
            </tr>
            <tr>
                <td><strong>Masa Kerja</strong></td>
                <td>: {{ $kenaikanGaji->masa_kerja_baru }} Tahun</td>
            </tr>
            <tr>
                <td><strong>TMT Kenaikan Gaji Berkala</strong></td>
                <td>: {{ \Carbon\Carbon::parse($kenaikanGaji->tmt_berkala_baru)->format('d F Y') }}</td>
            </tr>
        </table>
        
        <!-- Tabel Perhitungan Gaji -->
        <p><strong>Perhitungan Gaji Berkala:</strong></p>
        <table class="table-gaji">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="40%">Uraian</th>
                    <th width="25%">Gaji Lama</th>
                    <th width="30%">Gaji Baru</th>
                </tr>
            </thead>
            <tbody>
                @php
                    // Daftar gaji berdasarkan golongan (contoh, sesuaikan dengan data sebenarnya)
                    $gajiPokok = [
                        'Juru Muda' => 1_500_000,
                        'Juru Muda Tingkat I' => 1_650_000,
                        'Juru' => 1_800_000,
                        'Pengatur Muda' => 2_000_000,
                        'Pengatur Muda Tingkat I' => 2_200_000,
                        'Pengatur' => 2_400_000,
                        'Penata Muda' => 2_700_000,
                        'Penata Muda Tingkat I' => 3_000_000,
                        'Penata' => 3_300_000,
                        'Pembina' => 3_700_000,
                        'Pembina Tingkat I' => 4_100_000,
                        'Pembina Utama Muda' => 4_600_000,
                        'Pembina Utama Madya' => 5_100_000,
                        'Pembina Utama' => 5_600_000,
                        'III/D' => 3_500_000,
                        'IV/A' => 3_900_000,
                        'IV/B' => 4_300_000,
                        'IV/C' => 4_700_000,
                        'IV/D' => 5_100_000,
                        'IV/E' => 5_500_000,
                    ];
                    
                    $gajiLama = $gajiPokok[$kenaikanGaji->pangkat_lama] ?? 2_500_000;
                    $gajiBaru = $gajiPokok[$kenaikanGaji->pangkat_baru] ?? 2_800_000;
                    $kenaikan = $gajiBaru - $gajiLama;
                    $persenKenaikan = ($kenaikan / $gajiLama) * 100;
                    
                    // Tunjangan (contoh)
                    $tunjanganLama = [
                        'istri/suami' => $gajiLama * 0.1,
                        'anak' => $gajiLama * 0.02,
                        'fungsional' => $gajiLama * 0.2,
                        'struktural' => $gajiLama * 0.15,
                        'pangan' => 150_000,
                        'transport' => 200_000,
                    ];
                    
                    $tunjanganBaru = [
                        'istri/suami' => $gajiBaru * 0.1,
                        'anak' => $gajiBaru * 0.02,
                        'fungsional' => $gajiBaru * 0.2,
                        'struktural' => $gajiBaru * 0.15,
                        'pangan' => 150_000,
                        'transport' => 200_000,
                    ];
                    
                    $totalLama = $gajiLama + array_sum($tunjanganLama);
                    $totalBaru = $gajiBaru + array_sum($tunjanganBaru);
                @endphp
                
                <tr>
                    <td class="text-center">1</td>
                    <td>Gaji Pokok</td>
                    <td class="text-right">Rp {{ number_format($gajiLama, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($gajiBaru, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td>Tunjangan Istri/Suami (10%)</td>
                    <td class="text-right">Rp {{ number_format($tunjanganLama['istri/suami'], 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($tunjanganBaru['istri/suami'], 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="text-center">3</td>
                    <td>Tunjangan Anak (2% per anak)</td>
                    <td class="text-right">Rp {{ number_format($tunjanganLama['anak'], 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($tunjanganBaru['anak'], 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="text-center">4</td>
                    <td>Tunjangan Fungsional</td>
                    <td class="text-right">Rp {{ number_format($tunjanganLama['fungsional'], 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($tunjanganBaru['fungsional'], 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="text-center">5</td>
                    <td>Tunjangan Struktural</td>
                    <td class="text-right">Rp {{ number_format($tunjanganLama['struktural'], 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($tunjanganBaru['struktural'], 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="text-center">6</td>
                    <td>Tunjangan Pangan</td>
                    <td class="text-right">Rp {{ number_format($tunjanganLama['pangan'], 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($tunjanganBaru['pangan'], 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="text-center">7</td>
                    <td>Tunjangan Transport</td>
                    <td class="text-right">Rp {{ number_format($tunjanganLama['transport'], 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($tunjanganBaru['transport'], 0, ',', '.') }}</td>
                </tr>
                <tr class="total">
                    <td colspan="2" class="text-bold">JUMLAH PENGHASILAN PER BULAN</td>
                    <td class="text-right text-bold">Rp {{ number_format($totalLama, 0, ',', '.') }}</td>
                    <td class="text-right text-bold">Rp {{ number_format($totalBaru, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
        
        <!-- Ringkasan Kenaikan -->
        <table class="table-gaji">
            <thead>
                <tr>
                    <th width="40%">Keterangan</th>
                    <th width="60%">Nilai</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Besar Kenaikan Gaji Pokok</td>
                    <td class="text-right">Rp {{ number_format($kenaikan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Persentase Kenaikan</td>
                    <td class="text-right">{{ number_format($persenKenaikan, 2) }}%</td>
                </tr>
                <tr class="total">
                    <td class="text-bold">Kenaikan Total Penghasilan Per Bulan</td>
                    <td class="text-right text-bold">Rp {{ number_format($totalBaru - $totalLama, 0, ',', '.') }}</td>
                </tr>
                <tr class="total">
                    <td class="text-bold">Total Penghasilan Baru Per Bulan</td>
                    <td class="text-right text-bold">Rp {{ number_format($totalBaru, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Kenaikan Tahunan (12 bulan)</td>
                    <td class="text-right">Rp {{ number_format(($totalBaru - $totalLama) * 12, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
        
        <p>Keputusan ini mulai berlaku pada tanggal ditetapkan.</p>
        
        <div class="keterangan">
            <p>Catatan:</p>
            <ul>
                <li>Gaji dan tunjangan dibayarkan setiap bulan sesuai dengan ketentuan yang berlaku.</li>
                <li>Kenaikan gaji berkala ini berlaku selama 2 (dua) tahun ke depan.</li>
                <li>Apabila terdapat perubahan peraturan perundang-undangan, akan disesuaikan kemudian.</li>
            </ul>
        </div>
        
        <div class="signature">
            <table>
                <tr>
                    <td width="60%">
                        &nbsp;
                    </td>
                    <td style="text-align: center;">
                        Ditetapkan di : Jember<br>
                        Pada tanggal : {{ \Carbon\Carbon::parse($kenaikanGaji->tanggal_sk)->format('d F Y') }}<br><br><br><br>
                        KEPALA BPBD KABUPATEN JEMBER<br><br><br><br>
                        <u><strong>_________________________</strong></u><br>
                        NIP. ________________________
                    </td>
                </tr>
            </table>
        </div>
        
        <!-- Tambahan Tembusan -->
        <div style="margin-top: 40px; font-size: 10pt;">
            <p><strong>Tembusan:</strong><br>
            1. Bupati Jember (sebagai laporan);<br>
            2. Inspektorat Kabupaten Jember;<br>
            3. Badan Kepegawaian dan Pengembangan Sumber Daya Manusia Kabupaten Jember;<br>
            4. Kepala Subbagian Keuangan;<br>
            5. Arsip.</p>
        </div>
    </div>
</body>
</html>