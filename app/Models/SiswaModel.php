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
        'anak_ke',
        'jumlah_saudara',
        'alamat',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'no_hp',
        'email',
        'nama_ayah',
        'nama_ibu',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
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

    public function guruReferral()
    {
        return $this->belongsTo(Guru::class, 'referral_id', 'id');
    }
}
