@extends('layouts.app')

@section('title', 'Edit Pegawai')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Edit Data Pegawai</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="identitas-tab" data-bs-toggle="tab" data-bs-target="#identitas" type="button" role="tab">Identitas</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pendidikan-tab" data-bs-toggle="tab" data-bs-target="#pendidikan" type="button" role="tab">Riwayat Pendidikan</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="kepangkatan-tab" data-bs-toggle="tab" data-bs-target="#kepangkatan" type="button" role="tab">Riwayat Kepangkatan</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="jabatan-tab" data-bs-toggle="tab" data-bs-target="#jabatan" type="button" role="tab">Riwayat Jabatan</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pasangan-tab" data-bs-toggle="tab" data-bs-target="#pasangan" type="button" role="tab">Data Pasangan</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="anak-tab" data-bs-toggle="tab" data-bs-target="#anak" type="button" role="tab">Data Anak</button>
                </li>
            </ul>
            
            <div class="tab-content mt-3" id="myTabContent">
                <!-- Tab Identitas -->
                <div class="tab-pane fade show active" id="identitas" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                                   value="{{ old('nama', $pegawai->nama) }}" required>
                            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label>NIP <span class="text-danger">*</span></label>
                            <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" 
                                   value="{{ old('nip', $pegawai->nip) }}" required>
                            @error('nip') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <!-- Field Foto -->
                        <div class="col-md-12 mb-3">
                            <label>Foto Pegawai</label>
                            @if($pegawai->foto)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/foto/' . $pegawai->foto) }}" 
                                         alt="Foto {{ $pegawai->nama }}" 
                                         style="width: 100px; height: 100px; object-fit: cover; border-radius: 10px;">
                                    <br>
                                    <small class="text-muted">Foto saat ini</small>
                                </div>
                            @endif
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" 
                                   accept="image/*">
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti foto. Format: JPG, PNG, GIF. Maksimal 2MB</small>
                            @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label>Tempat Lahir <span class="text-danger">*</span></label>
                            <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" 
                                   value="{{ old('tempat_lahir', $pegawai->tempat_lahir) }}" required>
                            @error('tempat_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label>Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                   value="{{ old('tanggal_lahir', $pegawai->tanggal_lahir->format('Y-m-d')) }}" required>
                            @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label>Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jk" class="form-control @error('jk') is-invalid @enderror" required>
                                <option value="">Pilih</option>
                                <option value="L" {{ old('jk', $pegawai->jk) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jk', $pegawai->jk) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label>Agama <span class="text-danger">*</span></label>
                            <select name="agama" class="form-control @error('agama') is-invalid @enderror" required>
                                <option value="">Pilih</option>
                                <option value="Islam" {{ old('agama', $pegawai->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama', $pegawai->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('agama', $pegawai->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama', $pegawai->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama', $pegawai->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ old('agama', $pegawai->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                            </select>
                            @error('agama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="col-md-12 mb-3">
                            <label>Alamat <span class="text-danger">*</span></label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" required>{{ old('alamat', $pegawai->alamat) }}</textarea>
                            @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email', $pegawai->email) }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label>No. HP <span class="text-danger">*</span></label>
                            <input type="text" name="hp" class="form-control @error('hp') is-invalid @enderror" 
                                   value="{{ old('hp', $pegawai->hp) }}" required>
                            @error('hp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label>Pangkat Terakhir <span class="text-danger">*</span></label>
                            <input type="text" name="pangkat_terakhir" class="form-control @error('pangkat_terakhir') is-invalid @enderror" 
                                   value="{{ old('pangkat_terakhir', $pegawai->pangkat_terakhir) }}" required>
                            @error('pangkat_terakhir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label>Jabatan Terakhir <span class="text-danger">*</span></label>
                            <input type="text" name="jabatan_terakhir" class="form-control @error('jabatan_terakhir') is-invalid @enderror" 
                                   value="{{ old('jabatan_terakhir', $pegawai->jabatan_terakhir) }}" required>
                            @error('jabatan_terakhir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label>Unit Kerja <span class="text-danger">*</span></label>
                            <input type="text" name="unit_kerja" class="form-control @error('unit_kerja') is-invalid @enderror" 
                                   value="{{ old('unit_kerja', $pegawai->unit_kerja) }}" required>
                            @error('unit_kerja') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label>Pendidikan Terakhir <span class="text-danger">*</span></label>
                            <select name="pendidikan" class="form-control @error('pendidikan') is-invalid @enderror" required>
                                <option value="">Pilih</option>
                                <option value="SD" {{ old('pendidikan', $pegawai->pendidikan) == 'SD' ? 'selected' : '' }}>SD</option>
                                <option value="SMP" {{ old('pendidikan', $pegawai->pendidikan) == 'SMP' ? 'selected' : '' }}>SMP</option>
                                <option value="SMA" {{ old('pendidikan', $pegawai->pendidikan) == 'SMA' ? 'selected' : '' }}>SMA</option>
                                <option value="D3" {{ old('pendidikan', $pegawai->pendidikan) == 'D3' ? 'selected' : '' }}>D3</option>
                                <option value="S1" {{ old('pendidikan', $pegawai->pendidikan) == 'S1' ? 'selected' : '' }}>S1</option>
                                <option value="S2" {{ old('pendidikan', $pegawai->pendidikan) == 'S2' ? 'selected' : '' }}>S2</option>
                                <option value="S3" {{ old('pendidikan', $pegawai->pendidikan) == 'S3' ? 'selected' : '' }}>S3</option>
                            </select>
                            @error('pendidikan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label>Program Studi</label>
                            <input type="text" name="prodi" class="form-control" value="{{ old('prodi', $pegawai->prodi) }}">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label>SK CPNS</label>
                            <input type="text" name="sk_cpns" class="form-control" value="{{ old('sk_cpns', $pegawai->sk_cpns) }}">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label>SK PNS</label>
                            <input type="text" name="sk_pns" class="form-control" value="{{ old('sk_pns', $pegawai->sk_pns) }}">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label>Masa Kerja (Tahun) <span class="text-danger">*</span></label>
                            <input type="number" name="masa_kerja" class="form-control @error('masa_kerja') is-invalid @enderror" 
                                   value="{{ old('masa_kerja', $pegawai->masa_kerja) }}" required>
                            @error('masa_kerja') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label>TMT Berkala <span class="text-danger">*</span></label>
                            <input type="date" name="tmt_berkala" class="form-control @error('tmt_berkala') is-invalid @enderror" 
                                   value="{{ old('tmt_berkala', $pegawai->tmt_berkala->format('Y-m-d')) }}" required>
                            @error('tmt_berkala') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label>TMT Pensiun <span class="text-danger">*</span></label>
                            <input type="date" name="tmt_pensiun" class="form-control @error('tmt_pensiun') is-invalid @enderror" 
                                   value="{{ old('tmt_pensiun', $pegawai->tmt_pensiun->format('Y-m-d')) }}" required>
                            @error('tmt_pensiun') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label>Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="aktif" {{ old('status', $pegawai->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="pensiun" {{ old('status', $pegawai->status) == 'pensiun' ? 'selected' : '' }}>Pensiun</option>
                                <option value="mutasi" {{ old('status', $pegawai->status) == 'mutasi' ? 'selected' : '' }}>Mutasi</option>
                                <option value="nonaktif" {{ old('status', $pegawai->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Tab Riwayat Pendidikan -->
                <div class="tab-pane fade" id="pendidikan" role="tabpanel">
                    <div id="pendidikan-container">
                        @forelse($pegawai->riwayatPendidikan as $index => $pendidikan)
                        <div class="pendidikan-item mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Jenjang</label>
                                    <select name="riwayat_pendidikan[{{ $index }}][jenjang]" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="SD" {{ $pendidikan->jenjang == 'SD' ? 'selected' : '' }}>SD</option>
                                        <option value="SMP" {{ $pendidikan->jenjang == 'SMP' ? 'selected' : '' }}>SMP</option>
                                        <option value="SMA" {{ $pendidikan->jenjang == 'SMA' ? 'selected' : '' }}>SMA</option>
                                        <option value="D3" {{ $pendidikan->jenjang == 'D3' ? 'selected' : '' }}>D3</option>
                                        <option value="S1" {{ $pendidikan->jenjang == 'S1' ? 'selected' : '' }}>S1</option>
                                        <option value="S2" {{ $pendidikan->jenjang == 'S2' ? 'selected' : '' }}>S2</option>
                                        <option value="S3" {{ $pendidikan->jenjang == 'S3' ? 'selected' : '' }}>S3</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Sekolah/Universitas</label>
                                    <input type="text" name="riwayat_pendidikan[{{ $index }}][sekolah]" class="form-control" value="{{ $pendidikan->sekolah }}">
                                </div>
                                <div class="col-md-3">
                                    <label>Tahun Lulus</label>
                                    <input type="number" name="riwayat_pendidikan[{{ $index }}][tahun_lulus]" class="form-control" value="{{ $pendidikan->tahun_lulus }}">
                                </div>
                                <div class="col-md-1">
                                    <label>&nbsp;</label>
                                    <button type="button" class="btn btn-danger btn-sm remove-pendidikan">Hapus</button>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="pendidikan-item mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Jenjang</label>
                                    <select name="riwayat_pendidikan[0][jenjang]" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="SD">SD</option>
                                        <option value="SMP">SMP</option>
                                        <option value="SMA">SMA</option>
                                        <option value="D3">D3</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Sekolah/Universitas</label>
                                    <input type="text" name="riwayat_pendidikan[0][sekolah]" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label>Tahun Lulus</label>
                                    <input type="number" name="riwayat_pendidikan[0][tahun_lulus]" class="form-control">
                                </div>
                                <div class="col-md-1">
                                    <label>&nbsp;</label>
                                    <button type="button" class="btn btn-danger btn-sm remove-pendidikan" style="display:none;">Hapus</button>
                                </div>
                            </div>
                        </div>
                        @endforelse
                    </div>
                    <button type="button" class="btn btn-sm btn-primary" id="tambah-pendidikan">Tambah Pendidikan</button>
                </div>
                
                <!-- Tambahkan tab lainnya dengan pola yang sama -->
                <!-- ... -->
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Data</button>
                <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Dynamic form untuk pendidikan
    let pendidikanCount = {{ $pegawai->riwayatPendidikan->count() }};
    if (pendidikanCount === 0) pendidikanCount = 1;
    
    $('#tambah-pendidikan').click(function() {
        const newItem = $('.pendidikan-item:first').clone();
        newItem.find('input, select').val('');
        newItem.find('input, select').each(function() {
            const name = $(this).attr('name');
            if (name) {
                $(this).attr('name', name.replace(/\[\d+\]/, '[' + pendidikanCount + ']'));
            }
        });
        newItem.find('.remove-pendidikan').show();
        $('#pendidikan-container').append(newItem);
        pendidikanCount++;
    });
    
    $(document).on('click', '.remove-pendidikan', function() {
        $(this).closest('.pendidikan-item').remove();
        if ($('.pendidikan-item').length === 1) {
            $('.remove-pendidikan').hide();
        }
    });
    
    if ($('.pendidikan-item').length === 1) {
        $('.remove-pendidikan').hide();
    }
</script>
@endpush
@endsection