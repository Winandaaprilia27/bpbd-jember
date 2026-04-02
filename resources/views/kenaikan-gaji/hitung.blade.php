@extends('layouts.app')

@section('title', 'Proses Kenaikan Gaji')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Proses Kenaikan Gaji Berkala</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Data Pegawai</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                             <tr>
                                <th width="40%">Nama Lengkap</th>
                                <td>{{ $pegawai->nama }}</td>
                             </tr>
                             <tr>
                                <th>NIP</th>
                                <td>{{ $pegawai->nip }}</td>
                             </tr>
                             <tr>
                                <th>Pangkat/Golongan Saat Ini</th>
                                <td>{{ $pegawai->pangkat_terakhir }}</td>
                             </tr>
                             <tr>
                                <th>Jabatan</th>
                                <td>{{ $pegawai->jabatan_terakhir }}</td>
                             </tr>
                             <tr>
                                <th>Unit Kerja</th>
                                <td>{{ $pegawai->unit_kerja }}</td>
                             </tr>
                             <tr>
                                <th>TMT Berkala Saat Ini</th>
                                <td>{{ \Carbon\Carbon::parse($pegawai->tmt_berkala)->format('d-m-Y') }}</td>
                             </tr>
                             <tr>
                                <th>Masa Kerja Saat Ini</th>
                                <td>{{ $pegawai->masa_kerja }} Tahun</td>
                             </tr>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Hasil Perhitungan Kenaikan</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('kenaikan-gaji.simpan', $pegawai->id) }}" method="POST">
                            @csrf
                            
                            <!-- Input Hidden untuk data gaji -->
                            <input type="hidden" name="gaji_lama" value="{{ $gaji_lama ?? 0 }}">
                            <input type="hidden" name="gaji_baru" value="{{ $gaji_baru ?? 0 }}">
                            <input type="hidden" name="total_lama" value="{{ $total_lama ?? 0 }}">
                            <input type="hidden" name="total_baru" value="{{ $total_baru ?? 0 }}">
                            <input type="hidden" name="kenaikan_gaji" value="{{ $kenaikan_gaji ?? 0 }}">
                            <input type="hidden" name="kenaikan_total" value="{{ $kenaikan_total ?? 0 }}">
                            <input type="hidden" name="persen_kenaikan" value="{{ $persen_kenaikan ?? 0 }}">
                            
                            <table class="table table-bordered">
                                <tr>
                                    <th width="45%">TMT Berkala Baru</th>
                                    <td>
                                        <input type="date" name="tmt_berkala_baru" class="form-control" 
                                               value="{{ $tmt_baru->format('Y-m-d') }}" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Masa Kerja Baru</th>
                                    <td>
                                        <input type="number" name="masa_kerja_baru" class="form-control" 
                                               value="{{ $masa_kerja_baru }}" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Pangkat/Golongan Baru</th>
                                    <td>
                                        <input type="text" name="pangkat_baru" class="form-control" 
                                               value="{{ $pangkat_baru }}" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Gaji Pokok Lama</th>
                                    <td>
                                        <input type="text" class="form-control" 
                                               value="Rp {{ number_format($gaji_lama ?? 0, 0, ',', '.') }}" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Gaji Pokok Baru</th>
                                    <td>
                                        <input type="text" class="form-control" 
                                               value="Rp {{ number_format($gaji_baru ?? 0, 0, ',', '.') }}" readonly>
                                    </td>
                                </tr>
                                <tr class="table-info">
                                    <th>Kenaikan Gaji Pokok</th>
                                    <td>
                                        <input type="text" class="form-control fw-bold text-success" 
                                               value="Rp {{ number_format($kenaikan_gaji ?? 0, 0, ',', '.') }} ({{ number_format($persen_kenaikan ?? 0, 2) }}%)" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nomor SK <span class="text-danger">*</span></th>
                                    <td>
                                        <input type="text" name="nomor_sk" class="form-control" 
                                               placeholder="Contoh: 800/123/KEP/2024" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tanggal SK <span class="text-danger">*</span></th>
                                    <td>
                                        <input type="date" name="tanggal_sk" class="form-control" required>
                                    </td>
                                </tr>
                            </table>
                            
                            <div class="mt-3">
                                <button type="submit" class="btn btn-success btn-lg">
                                    💾 Simpan & Cetak SK
                                </button>
                                <a href="{{ route('kenaikan-gaji.index') }}" class="btn btn-secondary btn-lg">
                                    ⬅️ Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tabel Detail Perhitungan Gaji -->
        @if(isset($tunjanganLama) && isset($tunjanganBaru))
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Detail Perhitungan Gaji dan Tunjangan</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Uraian</th>
                                        <th class="text-end">Gaji Lama (Rp)</th>
                                        <th class="text-end">Gaji Baru (Rp)</th>
                                        <th class="text-end">Kenaikan (Rp)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table-primary">
                                        <td class="text-center">1</td>
                                        <td><strong>Gaji Pokok</strong></td>
                                        <td class="text-end"><strong>{{ number_format($gaji_lama, 0, ',', '.') }}</strong></td>
                                        <td class="text-end"><strong>{{ number_format($gaji_baru, 0, ',', '.') }}</strong></td>
                                        <td class="text-end text-success"><strong>{{ number_format($kenaikan_gaji, 0, ',', '.') }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">2</td>
                                        <td>Tunjangan Istri/Suami (10%)</td>
                                        <td class="text-end">{{ number_format($tunjanganLama['istri_suami'], 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($tunjanganBaru['istri_suami'], 0, ',', '.') }}</td>
                                        <td class="text-end text-success">{{ number_format($tunjanganBaru['istri_suami'] - $tunjanganLama['istri_suami'], 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">3</td>
                                        <td>Tunjangan Anak (2%)</td>
                                        <td class="text-end">{{ number_format($tunjanganLama['anak'], 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($tunjanganBaru['anak'], 0, ',', '.') }}</td>
                                        <td class="text-end text-success">{{ number_format($tunjanganBaru['anak'] - $tunjanganLama['anak'], 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">4</td>
                                        <td>Tunjangan Fungsional (20%)</td>
                                        <td class="text-end">{{ number_format($tunjanganLama['fungsional'], 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($tunjanganBaru['fungsional'], 0, ',', '.') }}</td>
                                        <td class="text-end text-success">{{ number_format($tunjanganBaru['fungsional'] - $tunjanganLama['fungsional'], 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">5</td>
                                        <td>Tunjangan Struktural (15%)</td>
                                        <td class="text-end">{{ number_format($tunjanganLama['struktural'], 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($tunjanganBaru['struktural'], 0, ',', '.') }}</td>
                                        <td class="text-end text-success">{{ number_format($tunjanganBaru['struktural'] - $tunjanganLama['struktural'], 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">6</td>
                                        <td>Tunjangan Pangan</td>
                                        <td class="text-end">{{ number_format($tunjanganLama['pangan'], 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($tunjanganBaru['pangan'], 0, ',', '.') }}</td>
                                        <td class="text-end text-success">{{ number_format($tunjanganBaru['pangan'] - $tunjanganLama['pangan'], 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">7</td>
                                        <td>Tunjangan Transport</td>
                                        <td class="text-end">{{ number_format($tunjanganLama['transport'], 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($tunjanganBaru['transport'], 0, ',', '.') }}</td>
                                        <td class="text-end text-success">{{ number_format($tunjanganBaru['transport'] - $tunjanganLama['transport'], 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">8</td>
                                        <td>Tunjangan Kinerja (30%)</td>
                                        <td class="text-end">{{ number_format($tunjanganLama['kinerja'], 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($tunjanganBaru['kinerja'], 0, ',', '.') }}</td>
                                        <td class="text-end text-success">{{ number_format($tunjanganBaru['kinerja'] - $tunjanganLama['kinerja'], 0, ',', '.') }}</td>
                                    </tr>
                                    <tr class="table-success">
                                        <td colspan="2" class="text-center fw-bold">TOTAL PENGHASILAN</td>
                                        <td class="text-end fw-bold">{{ number_format($total_lama, 0, ',', '.') }}</td>
                                        <td class="text-end fw-bold">{{ number_format($total_baru, 0, ',', '.') }}</td>
                                        <td class="text-end fw-bold text-success">{{ number_format($kenaikan_total, 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="alert alert-success mt-3">
                            <strong>📈 Ringkasan Kenaikan:</strong><br>
                            - Kenaikan Gaji Pokok: <strong>Rp {{ number_format($kenaikan_gaji, 0, ',', '.') }}</strong> ({{ number_format($persen_kenaikan, 2) }}%)<br>
                            - Kenaikan Total Penghasilan: <strong>Rp {{ number_format($kenaikan_total, 0, ',', '.') }}</strong><br>
                            - Total Penghasilan Baru per Bulan: <strong>Rp {{ number_format($total_baru, 0, ',', '.') }}</strong><br>
                            - Kenaikan Tahunan (12 bulan): <strong>Rp {{ number_format($kenaikan_total * 12, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="alert alert-warning">
                    <strong>⚠️ Perhatian:</strong> 
                    <ul class="mb-0">
                        <li>Kenaikan gaji berkala dilakukan setiap 2 tahun sekali</li>
                        <li>Pangkat/golongan akan naik sesuai dengan ketentuan yang berlaku</li>
                        <li>Pastikan nomor SK dan tanggal SK diisi dengan benar</li>
                        <li>Perhitungan tunjangan berdasarkan persentase dari gaji pokok</li>
                        <li>Setelah disimpan, SK Kenaikan Gaji akan otomatis dicetak</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .table th {
        background-color: #f8f9fa;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0,0,0,.05);
    }
    @media print {
        .btn, .card-header .float-end {
            display: none;
        }
    }
</style>
@endpush