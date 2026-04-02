@extends('layouts.app')

@section('title', 'Daftar Riwayat Hidup')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Daftar Riwayat Hidup Pegawai</h3>
        <a href="{{ route('riwayat-hidup.create') }}" class="btn btn-primary float-end">
            + Buat Riwayat Hidup
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama Pegawai</th>
                        <th>Nomor Dokumen</th>
                        <th>Tanggal Dibuat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($riwayatHidup as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->pegawai->nip }}</td>
                        <td>{{ $item->pegawai->nama }}</td>
                        <td>{{ $item->nomor_dokumen }}</td>
                        <td>{{ $item->tanggal_dibuat->format('d-m-Y') }}</td>
                        <td>
                            <span class="badge bg-{{ $item->status == 'aktif' ? 'success' : 'secondary' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('riwayat-hidup.show', $item->id) }}" class="btn btn-info btn-sm">Lihat</a>
                            <a href="{{ route('riwayat-hidup.print', $item->id) }}" class="btn btn-danger btn-sm" target="_blank">Cetak PDF</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $riwayatHidup->links() }}
    </div>
</div>
@endsection