@extends('layouts.app')

@section('title', 'Kenaikan Gaji Berkala')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Kenaikan Gaji Berkala</h3>
    </div>
    <div class="card-body">
        <div class="alert alert-info">
            <strong>Informasi:</strong> Berikut adalah pegawai yang akan mengalami kenaikan gaji berkala dalam 3 bulan ke depan.
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="kenaikanTable">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">NIP</th>
                        <th width="20%">Nama</th>
                        <th width="15%">Pangkat</th>
                        <th width="20%">Jabatan</th>
                        <th width="15%">TMT Berkala Saat Ini</th>
                        <th width="15%">Kenaikan Berikutnya</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pegawais as $index => $pegawai)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $pegawai->nip }}</td>
                        <td>{{ $pegawai->nama }}</td>
                        <td>{{ $pegawai->pangkat_terakhir }}</td>
                        <td>{{ $pegawai->jabatan_terakhir }}</td>
                        <td>{{ \Carbon\Carbon::parse($pegawai->tmt_berkala)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($pegawai->tmt_berkala)->addYears(2)->format('d-m-Y') }}</td>
                        <td class="text-center">
                            <a href="{{ route('kenaikan-gaji.hitung', $pegawai->id) }}" class="btn btn-primary btn-sm">
                                Proses Kenaikan
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada pegawai yang akan mengalami kenaikan gaji dalam 3 bulan ke depan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($pegawais->count() > 0)
        <div class="mt-3">
            {{ $pegawais->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#kenaikanTable').DataTable({
            "pageLength": 10,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "order": [[5, "asc"]]
        });
    });
</script>
@endpush