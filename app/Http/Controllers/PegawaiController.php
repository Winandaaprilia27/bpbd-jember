<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\RiwayatPendidikan;
use App\Models\RiwayatKepangkatan;
use App\Models\RiwayatJabatan;
use App\Models\DataPasangan;
use App\Models\DataAnak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PDF;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::with(['riwayatPendidikan', 'riwayatKepangkatan', 'riwayatJabatan'])
            ->orderBy('nama')
            ->paginate(10);
        return view('pegawai.index', compact('pegawais'));
    }

    public function create()
    {
        return view('pegawai.create');
    }

    public function store(Request $request)
    {
        // Validasi data utama termasuk foto
        $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:pegawais',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jk' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'email' => 'required|email|unique:pegawais',
            'hp' => 'required',
            'pangkat_terakhir' => 'required',
            'jabatan_terakhir' => 'required',
            'unit_kerja' => 'required',
            'pendidikan' => 'required',
            'masa_kerja' => 'required|integer',
            'tmt_berkala' => 'required|date',
            'tmt_pensiun' => 'required|date',
            'status' => 'required',
        ]);

        DB::beginTransaction();
        try {
            // Handle upload foto
            $fotoPath = null;
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fileName = time() . '_' . $request->nip . '.' . $foto->getClientOriginalExtension();
                $fotoPath = $foto->storeAs('foto', $fileName, 'public');
            }

            // Simpan data pegawai
            $pegawaiData = $request->except(['riwayat_pendidikan', 'riwayat_kepangkatan', 'riwayat_jabatan', 'data_pasangan', 'data_anak', 'foto']);
            $pegawaiData['foto'] = $fotoPath ? basename($fotoPath) : null;
            $pegawai = Pegawai::create($pegawaiData);

            // Simpan riwayat pendidikan
            if ($request->has('riwayat_pendidikan') && is_array($request->riwayat_pendidikan)) {
                foreach ($request->riwayat_pendidikan as $pendidikan) {
                    if (!empty($pendidikan['jenjang']) && !empty($pendidikan['sekolah']) && !empty($pendidikan['tahun_lulus'])) {
                        $pegawai->riwayatPendidikan()->create([
                            'jenjang' => $pendidikan['jenjang'],
                            'sekolah' => $pendidikan['sekolah'],
                            'tahun_lulus' => $pendidikan['tahun_lulus']
                        ]);
                    }
                }
            }

            // Simpan riwayat kepangkatan
            if ($request->has('riwayat_kepangkatan') && is_array($request->riwayat_kepangkatan)) {
                foreach ($request->riwayat_kepangkatan as $kepangkatan) {
                    if (!empty($kepangkatan['riwayat_kepangkatan']) && !empty($kepangkatan['pejabat'])) {
                        $pegawai->riwayatKepangkatan()->create([
                            'riwayat_kepangkatan' => $kepangkatan['riwayat_kepangkatan'],
                            'pejabat' => $kepangkatan['pejabat'],
                            'nomor' => $kepangkatan['nomor'] ?? null,
                            'tanggal' => $kepangkatan['tanggal'] ?? null,
                            'tmt' => $kepangkatan['tmt'] ?? null
                        ]);
                    }
                }
            }

            // Simpan riwayat jabatan
            if ($request->has('riwayat_jabatan') && is_array($request->riwayat_jabatan)) {
                foreach ($request->riwayat_jabatan as $jabatan) {
                    if (!empty($jabatan['riwayat_jabatan']) && !empty($jabatan['pejabat'])) {
                        $pegawai->riwayatJabatan()->create([
                            'riwayat_jabatan' => $jabatan['riwayat_jabatan'],
                            'pejabat' => $jabatan['pejabat'],
                            'nomor' => $jabatan['nomor'] ?? null,
                            'tanggal' => $jabatan['tanggal'] ?? null
                        ]);
                    }
                }
            }

            // Simpan data pasangan
            if ($request->has('data_pasangan') && is_array($request->data_pasangan)) {
                foreach ($request->data_pasangan as $pasangan) {
                    if (!empty($pasangan['suami_istri']) && !empty($pasangan['tempat_lahir'])) {
                        $pegawai->dataPasangan()->create([
                            'suami_istri' => $pasangan['suami_istri'],
                            'tempat_lahir' => $pasangan['tempat_lahir'],
                            'tanggal_lahir' => $pasangan['tanggal_lahir'] ?? null,
                            'pekerjaan' => $pasangan['pekerjaan'] ?? null,
                            'instansi' => $pasangan['instansi'] ?? null,
                            'urutan' => $pasangan['urutan'] ?? null
                        ]);
                    }
                }
            }

            // Simpan data anak
            if ($request->has('data_anak') && is_array($request->data_anak)) {
                foreach ($request->data_anak as $anak) {
                    if (!empty($anak['nama']) && !empty($anak['tempat_lahir'])) {
                        $pegawai->dataAnak()->create([
                            'nama' => $anak['nama'],
                            'tempat_lahir' => $anak['tempat_lahir'],
                            'tanggal_lahir' => $anak['tanggal_lahir'] ?? null,
                            'status' => $anak['status'] ?? null,
                            'dari_pasangan_ke' => $anak['dari_pasangan_ke'] ?? null,
                            'jk' => $anak['jk'] ?? 'L',
                            'status_kawin' => $anak['status_kawin'] ?? 'belum kawin',
                            'status_pekerjaan' => $anak['status_pekerjaan'] ?? null
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            if ($fotoPath && Storage::disk('public')->exists($fotoPath)) {
                Storage::disk('public')->delete($fotoPath);
            }
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Pegawai $pegawai)
    {
        $pegawai->load(['riwayatPendidikan', 'riwayatKepangkatan', 'riwayatJabatan', 'dataPasangan', 'dataAnak']);
        return view('pegawai.show', compact('pegawai'));
    }

    public function edit(Pegawai $pegawai)
    {
        $pegawai->load(['riwayatPendidikan', 'riwayatKepangkatan', 'riwayatJabatan', 'dataPasangan', 'dataAnak']);
        return view('pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        // Validasi lengkap
        $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:pegawais,nip,' . $pegawai->id,
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jk' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'email' => 'required|email|unique:pegawais,email,' . $pegawai->id,
            'hp' => 'required',
            'pangkat_terakhir' => 'required',
            'jabatan_terakhir' => 'required',
            'unit_kerja' => 'required',
            'pendidikan' => 'required',
            'masa_kerja' => 'required|integer',
            'tmt_berkala' => 'required|date',
            'tmt_pensiun' => 'required|date',
            'status' => 'required',
        ]);

        DB::beginTransaction();
        try {
            // Handle upload foto
            $fotoPath = $pegawai->foto;
            if ($request->hasFile('foto')) {
                // Hapus foto lama
                if ($pegawai->foto && Storage::disk('public')->exists('foto/' . $pegawai->foto)) {
                    Storage::disk('public')->delete('foto/' . $pegawai->foto);
                }
                
                $foto = $request->file('foto');
                $fileName = time() . '_' . $request->nip . '.' . $foto->getClientOriginalExtension();
                $storedPath = $foto->storeAs('foto', $fileName, 'public');
                $fotoPath = basename($storedPath);
            }

            // Update data pegawai
            $pegawai->update([
                'nama' => $request->nama,
                'nip' => $request->nip,
                'foto' => $fotoPath,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jk' => $request->jk,
                'agama' => $request->agama,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'hp' => $request->hp,
                'pangkat_terakhir' => $request->pangkat_terakhir,
                'jabatan_terakhir' => $request->jabatan_terakhir,
                'unit_kerja' => $request->unit_kerja,
                'pendidikan' => $request->pendidikan,
                'prodi' => $request->prodi,
                'sk_cpns' => $request->sk_cpns,
                'sk_pns' => $request->sk_pns,
                'masa_kerja' => $request->masa_kerja,
                'tmt_berkala' => $request->tmt_berkala,
                'tmt_pensiun' => $request->tmt_pensiun,
                'status' => $request->status,
            ]);

            // Update riwayat pendidikan
            $pegawai->riwayatPendidikan()->delete();
            if ($request->has('riwayat_pendidikan') && is_array($request->riwayat_pendidikan)) {
                foreach ($request->riwayat_pendidikan as $pendidikan) {
                    if (!empty($pendidikan['jenjang']) && !empty($pendidikan['sekolah']) && !empty($pendidikan['tahun_lulus'])) {
                        $pegawai->riwayatPendidikan()->create([
                            'jenjang' => $pendidikan['jenjang'],
                            'sekolah' => $pendidikan['sekolah'],
                            'tahun_lulus' => $pendidikan['tahun_lulus']
                        ]);
                    }
                }
            }

            // Update riwayat kepangkatan
            $pegawai->riwayatKepangkatan()->delete();
            if ($request->has('riwayat_kepangkatan') && is_array($request->riwayat_kepangkatan)) {
                foreach ($request->riwayat_kepangkatan as $kepangkatan) {
                    if (!empty($kepangkatan['riwayat_kepangkatan']) && !empty($kepangkatan['pejabat'])) {
                        $pegawai->riwayatKepangkatan()->create([
                            'riwayat_kepangkatan' => $kepangkatan['riwayat_kepangkatan'],
                            'pejabat' => $kepangkatan['pejabat'],
                            'nomor' => $kepangkatan['nomor'] ?? null,
                            'tanggal' => $kepangkatan['tanggal'] ?? null,
                            'tmt' => $kepangkatan['tmt'] ?? null
                        ]);
                    }
                }
            }

            // Update riwayat jabatan
            $pegawai->riwayatJabatan()->delete();
            if ($request->has('riwayat_jabatan') && is_array($request->riwayat_jabatan)) {
                foreach ($request->riwayat_jabatan as $jabatan) {
                    if (!empty($jabatan['riwayat_jabatan']) && !empty($jabatan['pejabat'])) {
                        $pegawai->riwayatJabatan()->create([
                            'riwayat_jabatan' => $jabatan['riwayat_jabatan'],
                            'pejabat' => $jabatan['pejabat'],
                            'nomor' => $jabatan['nomor'] ?? null,
                            'tanggal' => $jabatan['tanggal'] ?? null
                        ]);
                    }
                }
            }

            // Update data pasangan
            $pegawai->dataPasangan()->delete();
            if ($request->has('data_pasangan') && is_array($request->data_pasangan)) {
                foreach ($request->data_pasangan as $pasangan) {
                    if (!empty($pasangan['suami_istri']) && !empty($pasangan['tempat_lahir'])) {
                        $pegawai->dataPasangan()->create([
                            'suami_istri' => $pasangan['suami_istri'],
                            'tempat_lahir' => $pasangan['tempat_lahir'],
                            'tanggal_lahir' => $pasangan['tanggal_lahir'] ?? null,
                            'pekerjaan' => $pasangan['pekerjaan'] ?? null,
                            'instansi' => $pasangan['instansi'] ?? null,
                            'urutan' => $pasangan['urutan'] ?? null
                        ]);
                    }
                }
            }

            // Update data anak
            $pegawai->dataAnak()->delete();
            if ($request->has('data_anak') && is_array($request->data_anak)) {
                foreach ($request->data_anak as $anak) {
                    if (!empty($anak['nama']) && !empty($anak['tempat_lahir'])) {
                        $pegawai->dataAnak()->create([
                            'nama' => $anak['nama'],
                            'tempat_lahir' => $anak['tempat_lahir'],
                            'tanggal_lahir' => $anak['tanggal_lahir'] ?? null,
                            'status' => $anak['status'] ?? null,
                            'dari_pasangan_ke' => $anak['dari_pasangan_ke'] ?? null,
                            'jk' => $anak['jk'] ?? 'L',
                            'status_kawin' => $anak['status_kawin'] ?? 'belum kawin',
                            'status_pekerjaan' => $anak['status_pekerjaan'] ?? null
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diupdate');
            
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Pegawai $pegawai)
    {
        // Hapus foto jika ada
        if ($pegawai->foto && Storage::disk('public')->exists('foto/' . $pegawai->foto)) {
            Storage::disk('public')->delete('foto/' . $pegawai->foto);
        }
        
        $pegawai->delete();
        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil dihapus');
    }

    public function print($id)
    {
        $pegawai = Pegawai::with(['riwayatPendidikan', 'riwayatKepangkatan', 'riwayatJabatan', 'dataPasangan', 'dataAnak'])->findOrFail($id);
        $pdf = PDF::loadView('pegawai.print', compact('pegawai'));
        return $pdf->download('data-pegawai-' . $pegawai->nip . '.pdf');
    }

    /**
     * Menampilkan halaman riwayat hidup pegawai
     */
    public function riwayatHidup(Pegawai $pegawai)
    {
        $pegawai->load(['riwayatPendidikan', 'riwayatKepangkatan', 'riwayatJabatan', 'dataPasangan', 'dataAnak']);
        return view('pegawai.riwayat-hidup', compact('pegawai'));
    }

    /**
     * Cetak riwayat hidup dalam format PDF
     */
    public function printRiwayatHidup($id)
    {
        $pegawai = Pegawai::with(['riwayatPendidikan', 'riwayatKepangkatan', 'riwayatJabatan', 'dataPasangan', 'dataAnak'])->findOrFail($id);
        $pdf = PDF::loadView('pegawai.print-riwayat-hidup', compact('pegawai'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('riwayat-hidup-' . $pegawai->nip . '.pdf');
    }
}