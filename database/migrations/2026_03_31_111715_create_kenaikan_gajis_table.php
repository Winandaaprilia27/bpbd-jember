<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kenaikan_gajis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawais')->onDelete('cascade');
            $table->date('tmt_berkala_lama');
            $table->date('tmt_berkala_baru');
            $table->integer('masa_kerja_lama');
            $table->integer('masa_kerja_baru');
            $table->string('pangkat_lama');
            $table->string('pangkat_baru');
            $table->decimal('gaji_lama', 15, 2)->nullable();
            $table->decimal('gaji_baru', 15, 2)->nullable();
            $table->decimal('total_lama', 15, 2)->nullable();
            $table->decimal('total_baru', 15, 2)->nullable();
            $table->decimal('kenaikan_gaji', 15, 2)->nullable();
            $table->decimal('kenaikan_total', 15, 2)->nullable();
            $table->decimal('persen_kenaikan', 5, 2)->nullable();
            $table->string('nomor_sk')->nullable();
            $table->date('tanggal_sk')->nullable();
            $table->enum('status', ['proses', 'selesai'])->default('proses');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kenaikan_gajis');
    }
};