@extends('layouts.app')

@section('title', 'Tambah Pegawai')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Tambah Data Pegawai Baru</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('pegawai.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Terjadi kesalahan!</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" id="identitas-tab" data-bs-toggle="tab" data-bs-target="#identitas" type="button">Identitas</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="pendidikan-tab" data-bs-toggle="tab" data-bs-target="#pendidikan" type="button">Riwayat Pendidikan</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="kepangkatan-tab" data-bs-toggle="tab" data-bs-target="#kepangkatan" type="button">Riwayat Kepangkatan</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="jabatan-tab" data-bs-toggle="tab" data-bs-target="#jabatan" type="button">Riwayat Jabatan</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="pasangan-tab" data-bs-toggle="tab" data-bs-target="#pasangan" type="button">Data Pasangan</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="anak-tab" data-bs-toggle="tab" data-bs-target="#anak" type="button">Data Anak</button>
                </li>
            </ul>
            
            <div class="tab-content mt-3">
                <!-- ==================== TAB IDENTITAS ==================== -->
                <div class="tab-pane fade show active" id="identitas">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>NIP <span class="text-danger">*</span></label>
                            <input type="text" name="nip" class="form-control" value="{{ old('nip') }}" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Foto Pegawai</label>
                            <input type="file" name="foto" class="form-control" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG. Maksimal 2MB</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Tempat Lahir <span class="text-danger">*</span></label>
                            <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jk" class="form-control" required>
                                <option value="">Pilih</option>
                                <option value="L" {{ old('jk') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jk') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Agama <span class="text-danger">*</span></label>
                            <select name="agama" class="form-control" required>
                                <option value="">Pilih</option>
                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Alamat <span class="text-danger">*</span></label>
                            <textarea name="alamat" class="form-control" rows="2" required>{{ old('alamat') }}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>No. HP <span class="text-danger">*</span></label>
                            <input type="text" name="hp" class="form-control" value="{{ old('hp') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Pangkat Terakhir <span class="text-danger">*</span></label>
                            <input type="text" name="pangkat_terakhir" class="form-control" value="{{ old('pangkat_terakhir') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Jabatan Terakhir <span class="text-danger">*</span></label>
                            <input type="text" name="jabatan_terakhir" class="form-control" value="{{ old('jabatan_terakhir') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Unit Kerja <span class="text-danger">*</span></label>
                            <input type="text" name="unit_kerja" class="form-control" value="{{ old('unit_kerja') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Pendidikan Terakhir <span class="text-danger">*</span></label>
                            <select name="pendidikan" class="form-control" required>
                                <option value="">Pilih</option>
                                <option value="SD" {{ old('pendidikan') == 'SD' ? 'selected' : '' }}>SD</option>
                                <option value="SMP" {{ old('pendidikan') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                <option value="SMA" {{ old('pendidikan') == 'SMA' ? 'selected' : '' }}>SMA</option>
                                <option value="D3" {{ old('pendidikan') == 'D3' ? 'selected' : '' }}>D3</option>
                                <option value="S1" {{ old('pendidikan') == 'S1' ? 'selected' : '' }}>S1</option>
                                <option value="S2" {{ old('pendidikan') == 'S2' ? 'selected' : '' }}>S2</option>
                                <option value="S3" {{ old('pendidikan') == 'S3' ? 'selected' : '' }}>S3</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Program Studi</label>
                            <input type="text" name="prodi" class="form-control" value="{{ old('prodi') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>SK CPNS</label>
                            <input type="text" name="sk_cpns" class="form-control" value="{{ old('sk_cpns') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>SK PNS</label>
                            <input type="text" name="sk_pns" class="form-control" value="{{ old('sk_pns') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Masa Kerja (Tahun) <span class="text-danger">*</span></label>
                            <input type="number" name="masa_kerja" class="form-control" value="{{ old('masa_kerja') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>TMT Berkala <span class="text-danger">*</span></label>
                            <input type="date" name="tmt_berkala" class="form-control" value="{{ old('tmt_berkala') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>TMT Pensiun <span class="text-danger">*</span></label>
                            <input type="date" name="tmt_pensiun" class="form-control" value="{{ old('tmt_pensiun') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control" required>
                                <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="pensiun" {{ old('status') == 'pensiun' ? 'selected' : '' }}>Pensiun</option>
                                <option value="mutasi" {{ old('status') == 'mutasi' ? 'selected' : '' }}>Mutasi</option>
                                <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- ==================== TAB RIWAYAT PENDIDIKAN ==================== -->
                <div class="tab-pane fade" id="pendidikan">
                    <div class="alert alert-info">
                        <strong>Tips:</strong> Klik tombol "Tambah Pendidikan" untuk menambahkan riwayat pendidikan.
                    </div>
                    <div id="pendidikan-container">
                        <div class="pendidikan-item card mb-3 p-3">
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label>Jenjang <span class="text-danger">*</span></label>
                                    <select name="riwayat_pendidikan[0][jenjang]" class="form-control">
                                        <option value="">Pilih Jenjang</option>
                                        <option value="SD">SD</option>
                                        <option value="SMP">SMP</option>
                                        <option value="SMA">SMA</option>
                                        <option value="D3">D3</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label>Sekolah/Universitas <span class="text-danger">*</span></label>
                                    <input type="text" name="riwayat_pendidikan[0][sekolah]" class="form-control" placeholder="Nama Institusi">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Tahun Lulus <span class="text-danger">*</span></label>
                                    <input type="number" name="riwayat_pendidikan[0][tahun_lulus]" class="form-control" placeholder="Tahun">
                                </div>
                                <div class="col-md-1 mb-2">
                                    <label>&nbsp;</label>
                                    <button type="button" class="btn btn-danger btn-sm remove-pendidikan" style="display: none;">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success" id="tambah-pendidikan">+ Tambah Pendidikan</button>
                </div>
                
                <!-- ==================== TAB RIWAYAT KEPANGKATAN ==================== -->
                <div class="tab-pane fade" id="kepangkatan">
                    <div class="alert alert-info">
                        <strong>Tips:</strong> Klik tombol "Tambah Kepangkatan" untuk menambahkan riwayat kepangkatan.
                    </div>
                    <div id="kepangkatan-container">
                        <div class="kepangkatan-item card mb-3 p-3">
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <label>Pangkat/Golongan</label>
                                    <input type="text" name="riwayat_kepangkatan[0][riwayat_kepangkatan]" class="form-control" placeholder="Contoh: Penata Muda">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Pejabat</label>
                                    <input type="text" name="riwayat_kepangkatan[0][pejabat]" class="form-control" placeholder="Pejabat yang menetapkan">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label>Nomor SK</label>
                                    <input type="text" name="riwayat_kepangkatan[0][nomor]" class="form-control" placeholder="Nomor SK">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label>Tanggal SK</label>
                                    <input type="date" name="riwayat_kepangkatan[0][tanggal]" class="form-control">
                                </div>
                                <div class="col-md-1 mb-2">
                                    <label>TMT</label>
                                    <input type="date" name="riwayat_kepangkatan[0][tmt]" class="form-control">
                                </div>
                                <div class="col-md-1 mb-2">
                                    <label>&nbsp;</label>
                                    <button type="button" class="btn btn-danger btn-sm remove-kepangkatan" style="display: none;">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success" id="tambah-kepangkatan">+ Tambah Kepangkatan</button>
                </div>
                
                <!-- ==================== TAB RIWAYAT JABATAN ==================== -->
                <div class="tab-pane fade" id="jabatan">
                    <div class="alert alert-info">
                        <strong>Tips:</strong> Klik tombol "Tambah Jabatan" untuk menambahkan riwayat jabatan.
                    </div>
                    <div id="jabatan-container">
                        <div class="jabatan-item card mb-3 p-3">
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label>Riwayat Jabatan</label>
                                    <input type="text" name="riwayat_jabatan[0][riwayat_jabatan]" class="form-control" placeholder="Nama Jabatan">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Pejabat</label>
                                    <input type="text" name="riwayat_jabatan[0][pejabat]" class="form-control" placeholder="Pejabat yang menetapkan">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Nomor SK</label>
                                    <input type="text" name="riwayat_jabatan[0][nomor]" class="form-control" placeholder="Nomor SK">
                                </div>
                                <div class="col-md-1 mb-2">
                                    <label>Tanggal</label>
                                    <input type="date" name="riwayat_jabatan[0][tanggal]" class="form-control">
                                </div>
                                <div class="col-md-1 mb-2">
                                    <label>&nbsp;</label>
                                    <button type="button" class="btn btn-danger btn-sm remove-jabatan" style="display: none;">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success" id="tambah-jabatan">+ Tambah Jabatan</button>
                </div>
                
                <!-- ==================== TAB DATA PASANGAN ==================== -->
                <div class="tab-pane fade" id="pasangan">
                    <div class="alert alert-info">
                        <strong>Tips:</strong> Klik tombol "Tambah Pasangan" untuk menambahkan data pasangan (suami/istri).
                    </div>
                    <div id="pasangan-container">
                        <div class="pasangan-item card mb-3 p-3">
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <label>Nama Suami/Istri</label>
                                    <input type="text" name="data_pasangan[0][suami_istri]" class="form-control" placeholder="Nama lengkap">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label>Tempat Lahir</label>
                                    <input type="text" name="data_pasangan[0][tempat_lahir]" class="form-control" placeholder="Tempat lahir">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="data_pasangan[0][tanggal_lahir]" class="form-control">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label>Pekerjaan</label>
                                    <input type="text" name="data_pasangan[0][pekerjaan]" class="form-control" placeholder="Pekerjaan">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label>Instansi</label>
                                    <input type="text" name="data_pasangan[0][instansi]" class="form-control" placeholder="Instansi tempat kerja">
                                </div>
                                <div class="col-md-1 mb-2">
                                    <label>Urutan</label>
                                    <input type="number" name="data_pasangan[0][urutan]" class="form-control" value="1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success" id="tambah-pasangan">+ Tambah Pasangan</button>
                </div>
                
                <!-- ==================== TAB DATA ANAK ==================== -->
                <div class="tab-pane fade" id="anak">
                    <div class="alert alert-info">
                        <strong>Tips:</strong> Klik tombol "Tambah Anak" untuk menambahkan data anak.
                    </div>
                    <div id="anak-container">
                        <div class="anak-item card mb-3 p-3">
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <label>Nama Anak <span class="text-danger">*</span></label>
                                    <input type="text" name="data_anak[0][nama]" class="form-control" placeholder="Nama lengkap anak">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label>Tempat Lahir</label>
                                    <input type="text" name="data_anak[0][tempat_lahir]" class="form-control" placeholder="Tempat lahir">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="data_anak[0][tanggal_lahir]" class="form-control">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label>Status</label>
                                    <input type="text" name="data_anak[0][status]" class="form-control" placeholder="Anak kandung">
                                </div>
                                <div class="col-md-1 mb-2">
                                    <label>JK</label>
                                    <select name="data_anak[0][jk]" class="form-control">
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label>Status Pekerjaan</label>
                                    <input type="text" name="data_anak[0][status_pekerjaan]" class="form-control" placeholder="Pelajar/Mahasiswa/Bekerja">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-3 mb-2">
                                    <label>Dari Pasangan Ke-</label>
                                    <input type="number" name="data_anak[0][dari_pasangan_ke]" class="form-control" value="1">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Status Kawin</label>
                                    <select name="data_anak[0][status_kawin]" class="form-control">
                                        <option value="belum kawin">Belum Kawin</option>
                                        <option value="kawin">Kawin</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>&nbsp;</label>
                                    <button type="button" class="btn btn-danger btn-sm remove-anak" style="display: none;">Hapus Anak</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success" id="tambah-anak">+ Tambah Anak</button>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary btn-lg">💾 Simpan Semua Data</button>
                <a href="{{ route('pegawai.index') }}" class="btn btn-secondary btn-lg">❌ Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ============ VARIABEL COUNTER ============
    let pendidikanCounter = 1;
    let kepangkatanCounter = 1;
    let jabatanCounter = 1;
    let pasanganCounter = 1;
    let anakCounter = 1;
    
    // ============ TAMBAH PENDIDIKAN ============
    const tambahPendidikan = document.getElementById('tambah-pendidikan');
    if (tambahPendidikan) {
        tambahPendidikan.addEventListener('click', function() {
            const firstItem = document.querySelector('.pendidikan-item');
            if (firstItem) {
                const newItem = firstItem.cloneNode(true);
                newItem.querySelectorAll('input, select').forEach(input => {
                    if (input.type === 'text' || input.type === 'number') input.value = '';
                    if (input.type === 'date') input.value = '';
                    const name = input.getAttribute('name');
                    if (name) input.setAttribute('name', name.replace('[0]', '[' + pendidikanCounter + ']'));
                });
                const btnHapus = newItem.querySelector('.remove-pendidikan');
                if (btnHapus) btnHapus.style.display = 'inline-block';
                document.getElementById('pendidikan-container').appendChild(newItem);
                pendidikanCounter++;
            }
        });
    }
    
    // ============ TAMBAH KEPANGKATAN ============
    const tambahKepangkatan = document.getElementById('tambah-kepangkatan');
    if (tambahKepangkatan) {
        tambahKepangkatan.addEventListener('click', function() {
            const firstItem = document.querySelector('.kepangkatan-item');
            if (firstItem) {
                const newItem = firstItem.cloneNode(true);
                newItem.querySelectorAll('input, select').forEach(input => {
                    if (input.type === 'text' || input.type === 'number') input.value = '';
                    if (input.type === 'date') input.value = '';
                    const name = input.getAttribute('name');
                    if (name) input.setAttribute('name', name.replace('[0]', '[' + kepangkatanCounter + ']'));
                });
                const btnHapus = newItem.querySelector('.remove-kepangkatan');
                if (btnHapus) btnHapus.style.display = 'inline-block';
                document.getElementById('kepangkatan-container').appendChild(newItem);
                kepangkatanCounter++;
            }
        });
    }
    
    // ============ TAMBAH JABATAN ============
    const tambahJabatan = document.getElementById('tambah-jabatan');
    if (tambahJabatan) {
        tambahJabatan.addEventListener('click', function() {
            const firstItem = document.querySelector('.jabatan-item');
            if (firstItem) {
                const newItem = firstItem.cloneNode(true);
                newItem.querySelectorAll('input, select').forEach(input => {
                    if (input.type === 'text' || input.type === 'number') input.value = '';
                    if (input.type === 'date') input.value = '';
                    const name = input.getAttribute('name');
                    if (name) input.setAttribute('name', name.replace('[0]', '[' + jabatanCounter + ']'));
                });
                const btnHapus = newItem.querySelector('.remove-jabatan');
                if (btnHapus) btnHapus.style.display = 'inline-block';
                document.getElementById('jabatan-container').appendChild(newItem);
                jabatanCounter++;
            }
        });
    }
    
    // ============ TAMBAH PASANGAN ============
    const tambahPasangan = document.getElementById('tambah-pasangan');
    if (tambahPasangan) {
        tambahPasangan.addEventListener('click', function() {
            const firstItem = document.querySelector('.pasangan-item');
            if (firstItem) {
                const newItem = firstItem.cloneNode(true);
                newItem.querySelectorAll('input, select').forEach(input => {
                    if (input.type === 'text' || input.type === 'number') input.value = '';
                    if (input.type === 'date') input.value = '';
                    const name = input.getAttribute('name');
                    if (name) input.setAttribute('name', name.replace('[0]', '[' + pasanganCounter + ']'));
                });
                document.getElementById('pasangan-container').appendChild(newItem);
                pasanganCounter++;
            }
        });
    }
    
    // ============ TAMBAH ANAK ============
    const tambahAnak = document.getElementById('tambah-anak');
    if (tambahAnak) {
        tambahAnak.addEventListener('click', function() {
            const firstItem = document.querySelector('.anak-item');
            if (firstItem) {
                const newItem = firstItem.cloneNode(true);
                newItem.querySelectorAll('input, select').forEach(input => {
                    if (input.type === 'text' || input.type === 'number') input.value = '';
                    if (input.type === 'date') input.value = '';
                    const name = input.getAttribute('name');
                    if (name) input.setAttribute('name', name.replace('[0]', '[' + anakCounter + ']'));
                });
                const btnHapus = newItem.querySelector('.remove-anak');
                if (btnHapus) btnHapus.style.display = 'inline-block';
                document.getElementById('anak-container').appendChild(newItem);
                anakCounter++;
            }
        });
    }
    
    // ============ HAPUS FUNGSI ============
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-pendidikan')) {
            const item = e.target.closest('.pendidikan-item');
            if (item && document.querySelectorAll('.pendidikan-item').length > 1) item.remove();
            else alert('Minimal harus ada 1 data pendidikan');
        }
        if (e.target.classList.contains('remove-kepangkatan')) {
            const item = e.target.closest('.kepangkatan-item');
            if (item && document.querySelectorAll('.kepangkatan-item').length > 1) item.remove();
            else alert('Minimal harus ada 1 data kepangkatan');
        }
        if (e.target.classList.contains('remove-jabatan')) {
            const item = e.target.closest('.jabatan-item');
            if (item && document.querySelectorAll('.jabatan-item').length > 1) item.remove();
            else alert('Minimal harus ada 1 data jabatan');
        }
        if (e.target.classList.contains('remove-anak')) {
            const item = e.target.closest('.anak-item');
            if (item && document.querySelectorAll('.anak-item').length > 1) item.remove();
            else alert('Minimal harus ada 1 data anak');
        }
    });
    
    // Sembunyikan tombol hapus jika hanya 1 item
    if (document.querySelectorAll('.pendidikan-item').length === 1) {
        const btn = document.querySelector('.remove-pendidikan');
        if (btn) btn.style.display = 'none';
    }
    if (document.querySelectorAll('.kepangkatan-item').length === 1) {
        const btn = document.querySelector('.remove-kepangkatan');
        if (btn) btn.style.display = 'none';
    }
    if (document.querySelectorAll('.jabatan-item').length === 1) {
        const btn = document.querySelector('.remove-jabatan');
        if (btn) btn.style.display = 'none';
    }
    if (document.querySelectorAll('.anak-item').length === 1) {
        const btn = document.querySelector('.remove-anak');
        if (btn) btn.style.display = 'none';
    }
});
</script>
@endsection