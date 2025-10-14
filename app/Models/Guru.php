<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
     protected $table = 'gurus'; // sesuaikan dengan nama tabel migrasi
    protected $guarded = ['id'];
     protected $fillable = [
        'user_id',
        'nama',
        'nip',
        'email',
        'alamat',
        'no_hp',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function siswasReferral()
{
    return $this->hasMany(SiswaModel::class, 'referral_id', 'id');
}
 public function verificator()
    {
        return $this->hasOne(Verificator::class, 'guru_id');
    }

     public function seksipresensi()
    {
        return $this->hasOne(SeksiPresensi::class, 'guru_id');
    }

    public function tatausaha()
    {
        return $this->hasOne(SeksiPresensi::class, 'guru_id');
    }



}
