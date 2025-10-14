<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarUlang extends Model
{
    use HasFactory;

    protected $table = 'daftar_ulang';

    protected $guarded = [];
    protected $fillable = [
        'siswa_id',
        'tanggal',
        'jumlah',
        'keterangan',
    ];

    public function siswa(){
        return $this->belongsTo(SiswaModel::class, 'siswa_id', 'id');
    }
}
