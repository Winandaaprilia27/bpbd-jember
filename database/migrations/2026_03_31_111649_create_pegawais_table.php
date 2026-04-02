<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nip')->unique();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jk', ['L', 'P']);
            $table->string('agama');
            $table->text('alamat');
            $table->string('email')->unique();
            $table->string('hp');
            $table->string('pangkat_terakhir');
            $table->string('jabatan_terakhir');
            $table->string('unit_kerja');
            $table->string('pendidikan');
            $table->string('prodi')->nullable();
            $table->string('sk_cpns')->nullable();
            $table->string('sk_pns')->nullable();
            $table->integer('masa_kerja')->comment('dalam tahun');
            $table->date('tmt_berkala');
            $table->date('tmt_pensiun');
            $table->enum('status', ['aktif', 'pensiun', 'mutasi', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};