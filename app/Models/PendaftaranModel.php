<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranModel extends Model
{
    use HasFactory;
    public $table = 'pendaftaran';
    protected $guarded = ['id'];

    // relasi dengan siswa
    public function siswa()
    {
        return $this->belongsTo(SiswaModel::class, 'siswa_id', 'id');
    }
    public function detail_pendaftaran() {
        return $this->hasMany(PendaftaranDetailModel::class, 'pendaftaran_id', 'id');
    }
}
