@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Welcome Card -->
    <div class="col-12 mb-4">
        <div class="card bg-gradient-primary text-white">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="text-black mb-2">
                            <i class="fas fa-hand-wave me-2"></i>
                            Selamat Datang, {{ Auth::user()->name }}!
                        </h2>
                        <p class="text-black-50 mb-0">Sistem Informasi Kepegawaian BPBD Kabupaten Jember</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="text-black-50">
                            <i class="fas fa-calendar-alt me-1"></i>
                            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Pegawai</h6>
                            <h2 class="mb-0">{{ $totalPegawai ?? 0 }}</h2>
                        </div>
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                            <i class="fas fa-users text-primary fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Pegawai Aktif</h6>
                            <h2 class="mb-0">{{ $pegawaiAktif ?? 0 }}</h2>
                        </div>
                        <div class="rounded-circle bg-success bg-opacity-10 p-3">
                            <i class="fas fa-user-check text-success fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Akan Kenaikan Gaji</h6>
                            <h2 class="mb-0">{{ $kenaikanGaji ?? 0 }}</h2>
                        </div>
                        <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                            <i class="fas fa-chart-line text-warning fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Akan Pensiun (5 tahun)</h6>
                            <h2 class="mb-0">{{ $pensiun ?? 0 }}</h2>
                        </div>
                        <div class="rounded-circle bg-danger bg-opacity-10 p-3">
                            <i class="fas fa-calendar-check text-danger fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Pegawai -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-user-plus me-2 text-primary"></i>
                        Pegawai Terbaru
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Pangkat</th>
                                    <th>Jabatan</th>
                                    <th>Unit Kerja</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pegawaiTerbaru ?? [] as $pegawai)
                                <tr>
                                    <td>{{ $pegawai->nip }}</td>
                                    <td>{{ $pegawai->nama }}</td>
                                    <td>{{ $pegawai->pangkat_terakhir }}</td>
                                    <td>{{ $pegawai->jabatan_terakhir }}</td>
                                    <td>{{ $pegawai->unit_kerja }}</td>
                                    <td>
                                        <a href="{{ route('pegawai.show', $pegawai->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada data pegawai</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #2c7da0 0%, #1e5a77 100%);
    }
    .card {
        border-radius: 15px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .rounded-circle {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .bg-opacity-10 {
        --bs-bg-opacity: 0.1;
    }
    .table th {
        font-weight: 600;
        color: #2c3e50;
    }
</style>
@endpush