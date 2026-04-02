@extends('layouts.app')

@section('title', 'Riwayat Hidup - ' . $pegawai->nama)

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Riwayat Hidup Pegawai</h3>
        <div class="float-end">
            <button onclick="window.print()" class="btn btn-danger">
                🖨️ Cetak / PDF
            </button>
            <a href="{{ route('pegawai.show', $pegawai->id) }}" class="btn btn-secondary">
                ⬅️ Kembali
            </a>
        </div>
    </div>
    <div class="card-body">
        <!-- Kop Surat -->
        <div class="text-center mb-4">
            <h3>PEMERINTAH KABUPATEN JEMBER</h3>
            <h4>BADAN PENANGGULANGAN BENCANA DAERAH</h4>
            <p>Jl. Jawa No. 35, Jember, Jawa Timur 68121</p>
            <hr>
            <h4>DAFTAR RIWAYAT HIDUP</h4>
        </div>

        <!-- Foto dan Identitas -->
        <div class="row">
            <div class="col-md-3 text-center">
                @if($pegawai->foto && file_exists(public_path('storage/foto/' . $pegawai->foto)))
                    <img src="{{ asset('storage/foto/' . $pegawai->foto) }}" 
                         style="width: 150px; height: 150px; object-fit: cover; border: 1px solid #000;">
                @else
                    <div style="width: 150px; height: 150px; border: 1px solid #000; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                        PAS FOTO
                    </div>
                @endif
                <p class="mt-2"><strong>{{ $pegawai->nama }}</strong></p>
                <p>NIP. {{ $pegawai->nip }}</p>
            </div>
            <div class="col-md-9">
                <table class="table table-bordered">
                     <tr><th width="30%">Tempat, Tanggal Lahir</th><td>{{ $pegawai->tempat_lahir }}, {{ $pegawai->tanggal_lahir->format('d-m-Y') }}</td></tr>
                     <tr><th>Jenis Kelamin</th><td>{{ $pegawai->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
                     <tr><th>Agama</th><td>{{ $pegawai->agama }}</td></tr>
                     <tr><th>Alamat</th><td>{{ $pegawai->alamat }}</td></tr>
                     <tr><th>Email</th><td>{{ $pegawai->email }}</td></tr>
                     <tr><th>No. HP</th><td>{{ $pegawai->hp }}</td></tr>
                </table>
            </div>
        </div>

        <!-- Riwayat Pendidikan -->
        <h5 class="mt-4">A. RIWAYAT PENDIDIKAN</h5>
        <table class="table table-bordered">
            <thead class="table-light">
                 <tr><th>No</th><th>Jenjang</th><th>Nama Institusi</th><th>Tahun Lulus</th></tr>
            </thead>
            <tbody>
                @forelse($pegawai->riwayatPendidikan as $index => $pendidikan)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $pendidikan->jenjang }}</td>
                    <td>{{ $pendidikan->sekolah }}</td>
                    <td class="text-center">{{ $pendidikan->tahun_lulus }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center">Tidak ada data</td></tr>
                @endforelse
            </tbody>
        </table>

        <!-- Riwayat Kepangkatan -->
        <h5 class="mt-4">B. RIWAYAT KEPANGKATAN</h5>
        <table class="table table-bordered">
            <thead class="table-light">
                 <tr><th>No</th><th>Pangkat/Golongan</th><th>Nomor SK</th><th>Tanggal SK</th><th>TMT</th></tr>
            </thead>
            <tbody>
                @forelse($pegawai->riwayatKepangkatan as $index => $kepangkatan)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $kepangkatan->riwayat_kepangkatan }}</td>
                    <td>{{ $kepangkatan->nomor }}</td>
                    <td>{{ \Carbon\Carbon::parse($kepangkatan->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($kepangkatan->tmt)->format('d-m-Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center">Tidak ada data</td></tr>
                @endforelse
            </tbody>
        </table>

        <!-- Data Keluarga -->
        <h5 class="mt-4">C. DATA KELUARGA</h5>
        
        <h6>1. Pasangan</h6>
        <table class="table table-bordered">
            <thead class="table-light">
                 <tr><th>No</th><th>Nama</th><th>Tempat, Tanggal Lahir</th><th>Pekerjaan</th></tr>
            </thead>
            <tbody>
                @forelse($pegawai->dataPasangan as $index => $pasangan)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $pasangan->suami_istri }}</td>
                    <td>{{ $pasangan->tempat_lahir }}, {{ \Carbon\Carbon::parse($pasangan->tanggal_lahir)->format('d-m-Y') }}</td>
                    <td>{{ $pasangan->pekerjaan }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center">Tidak ada data</td></tr>
                @endforelse
            </tbody>
        </table>

        <h6>2. Anak</h6>
        <table class="table table-bordered">
            <thead class="table-light">
                 <tr><th>No</th><th>Nama</th><th>Tempat, Tanggal Lahir</th><th>Jenis Kelamin</th><th>Status</th></tr>
            </thead>
            <tbody>
                @forelse($pegawai->dataAnak as $index => $anak)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $anak->nama }}</td>
                    <td>{{ $anak->tempat_lahir }}, {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d-m-Y') }}</td>
                    <td>{{ $anak->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td>{{ $anak->status }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center">Tidak ada data</td></tr>
                @endforelse
            </tbody>
        </table>

        <!-- Data Kepegawaian -->
        <h5 class="mt-4">D. DATA KEPEGAWAIAN</h5>
        <table class="table table-bordered">
             <tr><th width="40%">Pangkat/Golongan Terakhir</th><td>{{ $pegawai->pangkat_terakhir }}</td></tr>
             <tr><th>Jabatan Terakhir</th><td>{{ $pegawai->jabatan_terakhir }}</td></tr>
             <tr><th>Unit Kerja</th><td>{{ $pegawai->unit_kerja }}</td></tr>
             <tr><th>Masa Kerja</th><td>{{ $pegawai->masa_kerja }} Tahun</td></tr>
             <tr><th>TMT Berkala</th><td>{{ $pegawai->tmt_berkala->format('d-m-Y') }}</td></tr>
             <tr><th>TMT Pensiun</th><td>{{ $pegawai->tmt_pensiun->format('d-m-Y') }}</td></tr>
             <tr><th>Status</th><td>{{ ucfirst($pegawai->status) }}</td></tr>
        </table>

        <!-- Tanda Tangan -->
        <div class="row mt-5">
            <div class="col-md-6">
                <p>Mengetahui,<br>Kepala BPBD Kab. Jember</p>
                <br><br><br>
                <p><u><strong>_________________________</strong></u><br>NIP. ________________________</p>
            </div>
            <div class="col-md-6 text-end">
                <p>Jember, {{ \Carbon\Carbon::now()->format('d F Y') }}<br>Yang Membuat,</p>
                <br><br><br>
                <p><u><strong>{{ $pegawai->nama }}</strong></u><br>NIP. {{ $pegawai->nip }}</p>
            </div>
        </div>
    </div>
</div>

<style media="print">
    .btn, .float-end, .card-header .float-end {
        display: none;
    }
    .card {
        border: none;
        margin: 0;
        padding: 0;
    }
    .card-header {
        display: none;
    }
    @page {
        size: A4;
        margin: 2cm;
    }
</style>
@endsection