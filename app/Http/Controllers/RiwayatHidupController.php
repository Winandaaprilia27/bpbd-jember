<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\RiwayatHidup;
use Illuminate\Http\Request;
use PDF;

class RiwayatHidupController extends Controller
{
    public function index()
    {
        $riwayatHidup = RiwayatHidup::with('pegawai')->orderBy('created_at', 'desc')->paginate(10);
        return view('riwayat-hidup.index', compact('riwayatHidup'));
    }

    public function create()
    {
        $pegawais = Pegawai::where('status', 'aktif')->orderBy('nama')->get();
        return view('riwayat-hidup.create', compact('pegawais'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'nomor_dokumen' => 'required|unique:riwayat_hidups',
            'tanggal_dibuat' => 'required|date',
        ]);

        $riwayatHidup = RiwayatHidup::create($request->all());

        return redirect()->route('riwayat-hidup.show', $riwayatHidup->id)
            ->with('success', 'Riwayat hidup berhasil dibuat');
    }

    public function show(RiwayatHidup $riwayatHidup)
    {
        $riwayatHidup->load('pegawai');
        return view('riwayat-hidup.show', compact('riwayatHidup'));
    }

    public function print($id)
    {
        $riwayatHidup = RiwayatHidup::with('pegawai')->findOrFail($id);
        $pdf = PDF::loadView('riwayat-hidup.print', compact('riwayatHidup'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('riwayat-hidup-' . $riwayatHidup->pegawai->nip . '.pdf');
    }

    public function cetak($pegawaiId)
    {
        $pegawai = Pegawai::with(['riwayatPendidikan', 'riwayatKepangkatan', 'riwayatJabatan', 'dataPasangan', 'dataAnak'])->findOrFail($pegawaiId);
        
        // Buat riwayat hidup baru
        $riwayatHidup = RiwayatHidup::create([
            'pegawai_id' => $pegawai->id,
            'nomor_dokumen' => 'RH/' . $pegawai->nip . '/' . date('YmdHis'),
            'tanggal_dibuat' => now(),
            'status' => 'aktif'
        ]);
        
        $pdf = PDF::loadView('riwayat-hidup.cetak', compact('pegawai', 'riwayatHidup'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('riwayat-hidup-' . $pegawai->nip . '.pdf');
    }
}