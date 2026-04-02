@extends('layouts.app')

@section('title', 'Data Pegawai')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Data Pegawai BPBD Kab. Jember</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="pegawaiTable">
                <thead>
                    <tr>
                        <th style="width: 5%">No</th>
                        <th style="width: 10%">Foto</th>  {{-- Kolom Foto ukuran 3x4 --}}
                        <th style="width: 12%">NIP</th>
                        <th style="width: 15%">Nama</th>
                        <th style="width: 12%">Pangkat</th>
                        <th style="width: 15%">Jabatan</th>
                        <th style="width: 12%">Unit Kerja</th>
                        <th style="width: 8%">Status</th>
                        <th style="width: 11%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pegawais as $index => $pegawai)
                    <tr>
                        {{-- Penomoran yang benar dengan pagination --}}
                        <td class="text-center">{{ $index + $pegawais->firstItem() }}</td>
                        
                        {{-- Kolom Foto ukuran 3x4 (105px x 140px) --}}
                        <td class="text-center">
                            @if($pegawai->foto)
                                <img src="{{ asset('storage/foto/' . $pegawai->foto) }}" 
                                     alt="Foto {{ $pegawai->nama }}" 
                                     class="foto-pegawai"
                                     style="width: 105px; height: 140px; object-fit: cover; border: 1px solid #ddd; border-radius: 3px;"
                                     onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?background=0D8ABC&color=fff&size=105&name={{ urlencode($pegawai->nama) }}&length=2&fontsize=50';">
                            @else
                                <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&size=105&name={{ urlencode($pegawai->nama) }}&length=2&fontsize=50" 
                                     alt="Foto {{ $pegawai->nama }}" 
                                     style="width: 105px; height: 140px; object-fit: cover; border: 1px solid #ddd; border-radius: 3px;">
                            @endif
                        </td>
                        
                        <td>{{ $pegawai->nip }}</td>
                        <td>{{ $pegawai->nama }}</td>
                        <td>{{ $pegawai->pangkat_terakhir }}</td>
                        <td>{{ $pegawai->jabatan_terakhir }}</td>
                        <td>{{ $pegawai->unit_kerja }}</td>
                        <td class="text-center">
                            <span class="badge bg-{{ $pegawai->status == 'aktif' ? 'success' : 'secondary' }}">
                                {{ ucfirst($pegawai->status) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('pegawai.show', $pegawai->id) }}" class="btn btn-info btn-sm" title="Lihat">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                                <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('pegawai.destroy', $pegawai->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')" title="Hapus">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                                <a href="{{ route('pegawai.print', $pegawai->id) }}" class="btn btn-secondary btn-sm" target="_blank" title="Cetak">
                                    <i class="fas fa-print"></i> Cetak
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        {{-- Link pagination --}}
        <div class="mt-3 d-flex justify-content-center">
            {{ $pegawais->links() }}
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Style untuk foto pegawai ukuran 3x4 */
    .foto-pegawai {
        width: 105px;
        height: 140px;
        object-fit: cover;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }
    
    .foto-pegawai:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
   
    .btn-group-sm > .btn {
        margin: 0 2px;
        padding: 0.25rem 0.5rem;
    }
    
    
    .table-responsive {
        overflow-x: auto;
    }
    
   
    .badge {
        font-size: 0.85rem;
        padding: 0.35rem 0.65rem;
    }
    
    
    .text-center {
        text-align: center;
        vertical-align: middle;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $('#pegawaiTable').DataTable({
            "pageLength": 10,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "columnDefs": [
                {
                    "targets": [1], 
                    "orderable": false,
                    "searchable": false,
                    "width": "105px"
                },
                {
                    "targets": [0], 
                    "orderable": true,
                    "searchable": false,
                    "width": "5%"
                },
                {
                    "targets": [8], 
                    "orderable": false,
                    "searchable": false
                }
            ],
            "autoWidth": false,
            "responsive": true
        });
    });
</script>
@endpush