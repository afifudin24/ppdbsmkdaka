<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaModel extends Model
{
    use HasFactory;

    protected $table = 'siswa'; // ✅ sesuaikan dengan nama tabel migrasi

    protected $fillable = [
        'no_reg',
        'user_id',
        'referral_id',
        'nama',
        'jurusan',
        'jenis_kelamin',
        'tempat_lahir',
        'tgl_lahir',
        'agama',
        'nik',
        'alamat',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'hp',
        'no_kk',
        'sekolah-asal',
        'agama',
        'nama_ayah',
        'nama_ibu',
        'foto',
        'kk',
        'akta',
        'kip',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'referral_id', 'id');
    }
     public function pendaftaran()
    {
        return $this->hasOne(PendaftaranDetailModel::class, 'siswa_id', 'id');
        // kalau 1 siswa bisa daftar lebih dari sekali pakai hasMany()
    }
    public function datakehadiran(){
        return $this->hasMany(DataKehadiran::class, 'siswa_id', 'id');
    }
}
