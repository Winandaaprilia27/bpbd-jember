@extends('layouts.app')

@section('title', 'Detail Riwayat Hidup')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Detail Riwayat Hidup</h3>
        <div class="float-end">
            <a href="{{ route('riwayat-hidup.print', $riwayatHidup->id) }}" class="btn btn-danger" target="_blank">
                🖨️ Cetak PDF
            </a>
            <a href="{{ route('riwayat-hidup.index') }}" class="btn btn-secondary">
                ⬅️ Kembali
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center mb-4">
                    <h3>PEMERINTAH KABUPATEN JEMBER</h3>
                    <h4>BADAN PENANGGULANGAN BENCANA DAERAH</h4>
                    <p>Jl. Jawa No. 35, Jember, Jawa Timur 68121</p>
                    <hr>
                    <h4>RIWAYAT HIDUP PEGAWAI</h4>
                    <p>Nomor: {{ $riwayatHidup->nomor_dokumen }}</p>
                    <p>Tanggal: {{ $riwayatHidup->tanggal_dibuat->format('d F Y') }}</p>
                </div>

                <!-- A. Identitas Pegawai -->
                <div class="section mb-4">
                    <h5>A. IDENTITAS PEGAWAI</h5>
                    <div class="row">
                        <div class="col-md-3 text-center">
                            @if($riwayatHidup->pegawai->foto)
                                <img src="{{ asset('storage/foto/' . $riwayatHidup->pegawai->foto) }}" 
                                     style="width: 120px; height: 150px; object-fit: cover; border: 1px solid #000;">
                            @else
                                <div style="width: 120px; height: 150px; border: 1px solid #000; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                                    <span>PAS FOTO</span>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-9">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">Nama Lengkap</th>
                                    <td>{{ $riwayatHidup->pegawai->nama }}</td>
                                </tr>
                                <tr>
                                    <th>NIP</th>
                                    <td>{{ $riwayatHidup->pegawai->nip }}</td>
                                </tr>
                                <tr>
                                    <th>Tempat, Tanggal Lahir</th>
                                    <td>{{ $riwayatHidup->pegawai->tempat_lahir }}, {{ $riwayatHidup->pegawai->tanggal_lahir->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>{{ $riwayatHidup->pegawai->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                </tr>
                                <tr>
                                    <th>Agama</th>
                                    <td>{{ $riwayatHidup->pegawai->agama }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $riwayatHidup->pegawai->alamat }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- B. Riwayat Pendidikan -->
                <div class="section mb-4">
                    <h5>B. RIWAYAT PENDIDIKAN</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenjang</th>
                                <th>Sekolah/Universitas</th>
                                <th>Tahun Lulus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayatHidup->pegawai->riwayatPendidikan as $index => $pendidikan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $pendidikan->jenjang }}</td>
                                <td>{{ $pendidikan->sekolah }}</td>
                                <td>{{ $pendidikan->tahun_lulus }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- C. Riwayat Kepangkatan -->
                <div class="section mb-4">
                    <h5>C. RIWAYAT KEPANGKATAN</h5>
                    <table class="table table-bordered">
                        <thead>
                            32<tr>
                                <th>No</th>
                                <th>Pangkat/Golongan</th>
                                <th>Nomor SK</th>
                                <th>Tanggal SK</th>
                                <th>TMT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayatHidup->pegawai->riwayatKepangkatan as $index => $kepangkatan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $kepangkatan->riwayat_kepangkatan }}</td>
                                <td>{{ $kepangkatan->nomor }}</td>
                                <td>{{ \Carbon\Carbon::parse($kepangkatan->tanggal)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($kepangkatan->tmt)->format('d-m-Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- D. Data Keluarga -->
                <div class="section mb-4">
                    <h5>D. DATA KELUARGA</h5>
                    <h6>Pasangan</h6>
                    <table class="table table-bordered">
                        <thead>
                            32<tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tempat, Tanggal Lahir</th>
                                <th>Pekerjaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayatHidup->pegawai->dataPasangan as $index => $pasangan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $pasangan->suami_istri }}</td>
                                <td>{{ $pasangan->tempat_lahir }}, {{ \Carbon\Carbon::parse($pasangan->tanggal_lahir)->format('d-m-Y') }}</td>
                                <td>{{ $pasangan->pekerjaan }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h6>Anak</h6>
                    <table class="table table-bordered">
                        <thead>
                            32<tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tempat, Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayatHidup->pegawai->dataAnak as $index => $anak)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $anak->nama }}</td>
                                <td>{{ $anak->tempat_lahir }}, {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d-m-Y') }}</td>
                                <td>{{ $anak->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- E. Data Kepegawaian -->
                <div class="section mb-4">
                    <h5>E. DATA KEPEGAWAIAN</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Pangkat/Golongan Terakhir</th>
                            <td>{{ $riwayatHidup->pegawai->pangkat_terakhir }}</td>
                        </tr>
                        <tr>
                            <th>Jabatan Terakhir</th>
                            <td>{{ $riwayatHidup->pegawai->jabatan_terakhir }}</td>
                        </tr>
                        <tr>
                            <th>Unit Kerja</th>
                            <td>{{ $riwayatHidup->pegawai->unit_kerja }}</td>
                        </tr>
                        <tr>
                            <th>Masa Kerja</th>
                            <td>{{ $riwayatHidup->pegawai->masa_kerja }} Tahun</td>
                        </tr>
                        <tr>
                            <th>TMT Berkala</th>
                            <td>{{ $riwayatHidup->pegawai->tmt_berkala->format('d-m-Y') }}</td>
                        </tr>
                    </table>
                </div>

                <!-- Tanda Tangan -->
                <div class="signature" style="margin-top: 50px;">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Mengetahui,<br>Kepala BPBD Kab. Jember</p>
                            <br><br><br>
                            <p><u><strong>_________________________</strong></u><br>NIP. ________________________</p>
                        </div>
                        <div class="col-md-6 text-end">
                            <p>Jember, {{ $riwayatHidup->tanggal_dibuat->format('d F Y') }}<br>Yang Membuat,</p>
                            <br><br><br>
                            <p><u><strong>{{ $riwayatHidup->pegawai->nama }}</strong></u><br>NIP. {{ $riwayatHidup->pegawai->nip }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection