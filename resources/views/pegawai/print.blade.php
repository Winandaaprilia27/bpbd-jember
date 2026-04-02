<!DOCTYPE html>
<html>
<head>
    <title>Data Pegawai - {{ $pegawai->nama }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 30px; }
        .title { font-size: 18px; font-weight: bold; }
        .subtitle { font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .section-title { font-size: 16px; font-weight: bold; margin-top: 20px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">PEMERINTAH KABUPATEN JEMBER</div>
        <div class="title">BADAN PENANGGULANGAN BENCANA DAERAH</div>
        <div class="subtitle">Jl. Jawa No. 35, Jember, Jawa Timur 68121</div>
        <hr>
        <div class="title">DATA PEGAWAI</div>
    </div>
    
    <div class="section-title">A. IDENTITAS PEGAWAI</div>
    <table>
        <tr><th width="30%">Nama</th><td>{{ $pegawai->nama }}</td></tr>
        <tr><th>NIP</th><td>{{ $pegawai->nip }}</td></tr>
        <tr><th>Tempat, Tanggal Lahir</th><td>{{ $pegawai->tempat_lahir }}, {{ $pegawai->tanggal_lahir->format('d-m-Y') }}</td></tr>
        <tr><th>Jenis Kelamin</th><td>{{ $pegawai->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
        <tr><th>Agama</th><td>{{ $pegawai->agama }}</td></tr>
        <tr><th>Alamat</th><td>{{ $pegawai->alamat }}</td></tr>
        <tr><th>Email</th><td>{{ $pegawai->email }}</td></tr>
        <tr><th>No. HP</th><td>{{ $pegawai->hp }}</td></tr>
        <tr><th>Pangkat Terakhir</th><td>{{ $pegawai->pangkat_terakhir }}</td></tr>
        <tr><th>Jabatan Terakhir</th><td>{{ $pegawai->jabatan_terakhir }}</td></tr>
        <tr><th>Unit Kerja</th><td>{{ $pegawai->unit_kerja }}</td></tr>
        <tr><th>Pendidikan</th><td>{{ $pegawai->pendidikan }} {{ $pegawai->prodi ? '('.$pegawai->prodi.')' : '' }}</td></tr>
        <tr><th>SK CPNS</th><td>{{ $pegawai->sk_cpns ?? '-' }}</td></tr>
        <tr><th>SK PNS</th><td>{{ $pegawai->sk_pns ?? '-' }}</td></tr>
        <tr><th>Masa Kerja</th><td>{{ $pegawai->masa_kerja }} Tahun</td></tr>
        <tr><th>TMT Berkala</th><td>{{ $pegawai->tmt_berkala->format('d-m-Y') }}</td></tr>
        <tr><th>TMT Pensiun</th><td>{{ $pegawai->tmt_pensiun->format('d-m-Y') }}</td></tr>
        <tr><th>Status</th><td>{{ ucfirst($pegawai->status) }}</td></tr>
    </table>
    
    @if($pegawai->riwayatPendidikan->count() > 0)
    <div class="section-title">B. RIWAYAT PENDIDIKAN</div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Jenjang</th>
                <th>Sekolah/Universitas</th>
                <th>Tahun Lulus</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pegawai->riwayatPendidikan as $index => $pendidikan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $pendidikan->jenjang }}</td>
                <td>{{ $pendidikan->sekolah }}</td>
                <td>{{ $pendidikan->tahun_lulus }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    
    @if($pegawai->riwayatKepangkatan->count() > 0)
    <div class="section-title">C. RIWAYAT KEPANGKATAN</div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Riwayat Kepangkatan</th>
                <th>Pejabat</th>
                <th>Nomor SK</th>
                <th>Tanggal SK</th>
                <th>TMT</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pegawai->riwayatKepangkatan as $index => $kepangkatan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $kepangkatan->riwayat_kepangkatan }}</td>
                <td>{{ $kepangkatan->pejabat }}</td>
                <td>{{ $kepangkatan->nomor }}</td>
                <td>{{ $kepangkatan->tanggal->format('d-m-Y') }}</td>
                <td>{{ $kepangkatan->tmt->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    
    <!-- Lanjutkan untuk jabatan, pasangan, anak dengan format yang sama -->
    
    <div style="margin-top: 50px;">
        <table>
            <tr>
                <td width="60%"></td>
                <td style="text-align: center;">
                    Jember, {{ date('d-m-Y') }}<br>
                    Kepala BPBD Kab. Jember<br><br><br><br>
                    (_________________________)
                </td>
            </tr>
        </table>
    </div>
</body>
</html>