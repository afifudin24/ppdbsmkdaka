<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('no_regis')->nullable(true);
            $table->string('nama')->nullable(true);
            $table->string('nisn')->nullable(true);
            $table->string('nis')->nullable(true);
            $table->string('jurusan')->nullable(true);
            $table->string('jenis_kelamin')->nullable(true);
            $table->string('tempat_lahir')->nullable(true);
            $table->string('tgl_lahir')->nullable(true);
            $table->string('agama')->nullable(true);
            $table->integer('anak_ke')->nullable(true);
            $table->integer('jumlah_saudara')->nullable(true);
            $table->string('hobi')->nullable(true);
            $table->string('cita_cita')->nullable(true);
            $table->string('hp')->nullable(true);
            $table->string('email')->unique()->nullable(true);
            $table->string('password')->nullable(true);
            $table->string('jenis_tempat_tinggal')->nullable(true);
            $table->string('alamat')->nullable(true);
            $table->string('desa')->nullable(true);
            $table->string('kecamatan')->nullable(true);
            $table->string('kabupaten')->nullable(true);
            $table->string('provinsi')->nullable(true);
            $table->string('pos')->nullable(true);
            $table->string('jarak')->nullable(true);
            $table->string('transportasi')->nullable(true);
            $table->integer('no_kk')->nullable(true);
            $table->string('kepala_kk')->nullable(true);
            $table->string('nama_ayah')->nullable(true);
            $table->string('nik_ayah')->nullable(true);
            $table->string('tahun_lahir_ayah')->nullable(true);
            $table->string('pekerjaan_ayah')->nullable(true);
            $table->integer('penghasilan_ayah')->nullable(true);
            $table->string('pendidikan_ayah')->nullable(true);
            $table->string('nama_ibu')->nullable(true);
            $table->string('nik_ibu')->nullable(true);
            $table->string('tahun_lahir_ibu')->nullable(true);
            $table->string('pekerjaan_ibu')->nullable(true);
            $table->integer('penghasilan_ibu')->nullable(true);
            $table->string('pendidikan_ibu')->nullable(true);
            $table->string('sekolah_asal')->nullable(true);
            $table->string('jenjang_sekolah')->nullable(true);
            $table->string('npsn_sekolah')->nullable(true);
            $table->string('foto')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
