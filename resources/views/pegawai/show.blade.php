@extends('layouts.app')

@section('title', 'Detail Pegawai')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Detail Data Pegawai</h3>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" id="identitas-tab" data-bs-toggle="tab" data-bs-target="#identitas" type="button" role="tab">Identitas</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="pendidikan-tab" data-bs-toggle="tab" data-bs-target="#pendidikan" type="button" role="tab">Riwayat Pendidikan</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="kepangkatan-tab" data-bs-toggle="tab" data-bs-target="#kepangkatan" type="button" role="tab">Riwayat Kepangkatan</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="jabatan-tab" data-bs-toggle="tab" data-bs-target="#jabatan" type="button" role="tab">Riwayat Jabatan</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="pasangan-tab" data-bs-toggle="tab" data-bs-target="#pasangan" type="button" role="tab">Data Pasangan</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="anak-tab" data-bs-toggle="tab" data-bs-target="#anak" type="button" role="tab">Data Anak</button>
            </li>
        </ul>
        
        <div class="tab-content mt-3">
            <!-- Tab Identitas dengan Foto -->
            <div class="tab-pane fade show active" id="identitas" role="tabpanel">
                <div class="row">
                    <div class="col-md-3 text-center mb-3">
                        @if($pegawai->foto && file_exists(public_path('storage/foto/' . $pegawai->foto)))
                            <img src="{{ asset('storage/foto/' . $pegawai->foto) }}" 
                                 alt="Foto {{ $pegawai->nama }}" 
                                 style="width: 150px; height: 150px; object-fit: cover; border-radius: 10px; border: 3px solid #0D8ABC;">
                        @else
                            <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&size=150&name={{ urlencode($pegawai->nama) }}" 
                                 alt="Foto {{ $pegawai->nama }}" 
                                 style="width: 150px; height: 150px; object-fit: cover; border-radius: 10px; border: 3px solid #0D8ABC;">
                        @endif
                        <h5 class="mt-2">{{ $pegawai->nama }}</h5>
                        <p class="text-muted">NIP. {{ $pegawai->nip }}</p>
                    </div>
                    <div class="col-md-9">
                        <table class="table table-bordered">
                            <tr>
                                <th width="200">Nama Lengkap</th>
                                <td>{{ $pegawai->nama }}</td>
                                <th width="200">NIP</th>
                                <td>{{ $pegawai->nip }}</td>
                            </tr>
                            <tr>
                                <th>Tempat, Tanggal Lahir</th>
                                <td>{{ $pegawai->tempat_lahir }}, {{ $pegawai->tanggal_lahir->format('d-m-Y') }}</td>
                                <th>Jenis Kelamin</th>
                                <td>{{ $pegawai->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            </tr>
                            <tr>
                                <th>Agama</th>
                                <td>{{ $pegawai->agama }}</td>
                                <th>Alamat</th>
                                <td>{{ $pegawai->alamat }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $pegawai->email }}</td>
                                <th>No. HP</th>
                                <td>{{ $pegawai->hp }}</td>
                            </tr>
                            <tr>
                                <th>Pangkat Terakhir</th>
                                <td>{{ $pegawai->pangkat_terakhir }}</td>
                                <th>Jabatan Terakhir</th>
                                <td>{{ $pegawai->jabatan_terakhir }}</td>
                            </tr>
                            <tr>
                                <th>Unit Kerja</th>
                                <td>{{ $pegawai->unit_kerja }}</td>
                                <th>Pendidikan</th>
                                <td>{{ $pegawai->pendidikan }} {{ $pegawai->prodi ? '('.$pegawai->prodi.')' : '' }}</td>
                            </tr>
                            <tr>
                                <th>SK CPNS</th>
                                <td>{{ $pegawai->sk_cpns ?? '-' }}</td>
                                <th>SK PNS</th>
                                <td>{{ $pegawai->sk_pns ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Masa Kerja</th>
                                <td>{{ $pegawai->masa_kerja }} Tahun</td>
                                <th>TMT Berkala</th>
                                <td>{{ $pegawai->tmt_berkala->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <th>TMT Pensiun</th>
                                <td>{{ $pegawai->tmt_pensiun->format('d-m-Y') }}</td>
                                <th>Status</th>
                                <td>
                                    <span class="badge bg-{{ $pegawai->status == 'aktif' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($pegawai->status) }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Tab Riwayat Pendidikan -->
            <div class="tab-pane fade" id="pendidikan" role="tabpanel">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Jenjang</th>
                            <th width="55%">Sekolah/Universitas</th>
                            <th width="20%">Tahun Lulus</th>
                        </tr>
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
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data riwayat pendidikan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Tab Riwayat Kepangkatan -->
            <div class="tab-pane fade" id="kepangkatan" role="tabpanel">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="25%">Riwayat Kepangkatan</th>
                            <th width="20%">Pejabat</th>
                            <th width="20%">Nomor SK</th>
                            <th width="15%">Tanggal SK</th>
                            <th width="15%">TMT</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pegawai->riwayatKepangkatan as $index => $kepangkatan)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $kepangkatan->riwayat_kepangkatan }}</td>
                            <td>{{ $kepangkatan->pejabat }}</td>
                            <td>{{ $kepangkatan->nomor }}</td>
                            <td>{{ $kepangkatan->tanggal->format('d-m-Y') }}</td>
                            <td>{{ $kepangkatan->tmt->format('d-m-Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data riwayat kepangkatan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Tab Riwayat Jabatan -->
            <div class="tab-pane fade" id="jabatan" role="tabpanel">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="40%">Riwayat Jabatan</th>
                            <th width="25%">Pejabat</th>
                            <th width="20%">Nomor SK</th>
                            <th width="10%">Tanggal SK</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pegawai->riwayatJabatan as $index => $jabatan)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $jabatan->riwayat_jabatan }}</td>
                            <td>{{ $jabatan->pejabat }}</td>
                            <td>{{ $jabatan->nomor }}</td>
                            <td>{{ $jabatan->tanggal->format('d-m-Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data riwayat jabatan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Tab Data Pasangan -->
            <div class="tab-pane fade" id="pasangan" role="tabpanel">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="25%">Nama Suami/Istri</th>
                            <th width="30%">Tempat, Tanggal Lahir</th>
                            <th width="20%">Pekerjaan</th>
                            <th width="15%">Instansi</th>
                            <th width="5%">Urutan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pegawai->dataPasangan as $index => $pasangan)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $pasangan->suami_istri }}</td>
                            <td>{{ $pasangan->tempat_lahir }}, {{ $pasangan->tanggal_lahir->format('d-m-Y') }}</td>
                            <td>{{ $pasangan->pekerjaan }}</td>
                            <td>{{ $pasangan->instansi ?? '-' }}</td>
                            <td class="text-center">{{ $pasangan->urutan ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data pasangan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Tab Data Anak -->
            <div class="tab-pane fade" id="anak" role="tabpanel">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Nama</th>
                            <th width="25%">Tempat, Tanggal Lahir</th>
                            <th width="15%">Status</th>
                            <th width="10%">JK</th>
                            <th width="15%">Status Kawin</th>
                            <th width="10%">Status Pekerjaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pegawai->dataAnak as $index => $anak)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $anak->nama }}</td>
                            <td>{{ $anak->tempat_lahir }}, {{ $anak->tanggal_lahir->format('d-m-Y') }}</td>
                            <td>{{ $anak->status }}</td>
                            <td class="text-center">{{ $anak->jk == 'L' ? 'L' : 'P' }}</td>
                            <td>{{ ucfirst($anak->status_kawin) }}</td>
                            <td>{{ $anak->status_pekerjaan }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data anak</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Tombol Aksi -->
        <div class="mt-4">
            <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> ✏️ Edit
            </a>
            <a href="{{ route('pegawai.riwayat-hidup', $pegawai->id) }}" class="btn btn-info">
                <i class="fas fa-file-alt"></i> 📄 Riwayat Hidup
            </a>
            <a href="{{ route('pegawai.print', $pegawai->id) }}" class="btn btn-secondary" target="_blank">
                <i class="fas fa-print"></i> 🖨️ Cetak Data
            </a>
            <a href="{{ route('pegawai.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> ⬅️ Kembali
            </a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }
    .nav-tabs .nav-link {
        color: #495057;
    }
    .nav-tabs .nav-link.active {
        color: #0D8ABC;
        font-weight: bold;
    }
    .badge {
        padding: 5px 10px;
        font-size: 12px;
    }
</style>
@endpush