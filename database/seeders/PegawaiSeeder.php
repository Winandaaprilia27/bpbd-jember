<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PegawaiSeeder extends Seeder
{
    public function run(): void
    {
        // Cek apakah sudah ada data
        if (Pegawai::count() == 0) {
            Pegawai::create([
                'nama' => 'Winanda Aprilia Putri',
                'nip' => '197506172010011012',
                'tempat_lahir' => 'Jember',
                'tanggal_lahir' => '1975-06-17',
                'jk' => 'P',
                'agama' => 'Islam',
                'alamat' => 'Jl. Merpati No. 10, Jember',
                'email' => 'winanda@bpbd.jember.go.id',
                'hp' => '081234567890',
                'pangkat_terakhir' => 'III/D',
                'jabatan_terakhir' => 'Penata Utama',
                'unit_kerja' => 'Badan Penanggulangan Bencana Daerah',
                'pendidikan' => 'S1',
                'prodi' => 'Administrasi Negara',
                'sk_cpns' => '800/123/KEP/2005',
                'sk_pns' => '800/456/KEP/2008',
                'masa_kerja' => 15,
                'tmt_berkala' => '2024-01-01',
                'tmt_pensiun' => '2040-06-17',
                'status' => 'aktif',
            ]);
            $this->command->info('Sample pegawai created!');
        } else {
            $this->command->info('Pegawai data already exists!');
        }
    }
}