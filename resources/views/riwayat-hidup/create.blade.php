@extends('layouts.app')

@section('title', 'Buat Riwayat Hidup')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Buat Riwayat Hidup Baru</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('riwayat-hidup.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Pilih Pegawai <span class="text-danger">*</span></label>
                    <select name="pegawai_id" class="form-control @error('pegawai_id') is-invalid @enderror" required>
                        <option value="">Pilih Pegawai</option>
                        @foreach($pegawais as $pegawai)
                        <option value="{{ $pegawai->id }}">{{ $pegawai->nip }} - {{ $pegawai->nama }}</option>
                        @endforeach
                    </select>
                    @error('pegawai_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label>Nomor Dokumen <span class="text-danger">*</span></label>
                    <input type="text" name="nomor_dokumen" class="form-control @error('nomor_dokumen') is-invalid @enderror" 
                           value="RH/{{ date('YmdHis') }}" required>
                    @error('nomor_dokumen') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label>Tanggal Dibuat <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_dibuat" class="form-control @error('tanggal_dibuat') is-invalid @enderror" 
                           value="{{ date('Y-m-d') }}" required>
                    @error('tanggal_dibuat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Buat Riwayat Hidup</button>
            <a href="{{ route('riwayat-hidup.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection