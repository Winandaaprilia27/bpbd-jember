<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total pegawai
        $totalPegawai = Pegawai::count();
        
        // Pegawai aktif
        $pegawaiAktif = Pegawai::where('status', 'aktif')->count();
        
        // Pegawai yang akan kenaikan gaji dalam 3 bulan
        $kenaikanGaji = Pegawai::where('status', 'aktif')
            ->where('tmt_berkala', '<=', Carbon::now()->addMonths(3))
            ->count();
        
        // Pegawai yang akan pensiun dalam 5 tahun
        $pensiun = Pegawai::where('tmt_pensiun', '<=', Carbon::now()->addYears(5))
            ->count();
        
        // Pegawai terbaru (5 data terakhir)
        $pegawaiTerbaru = Pegawai::orderBy('created_at', 'desc')->limit(5)->get();
        
        return view('dashboard.index', compact(
            'totalPegawai',
            'pegawaiAktif',
            'kenaikanGaji',
            'pensiun',
            'pegawaiTerbaru'
        ));
    }
}