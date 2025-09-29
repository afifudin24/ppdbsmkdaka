<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeksiPresensi extends Model
{
    use HasFactory;
    protected $table = 'seksi_presensi';
    protected $fillable = [
        'guru_id'
    ];

     public function guru()
{
    return $this->belongsTo(Guru::class, 'guru_id');
}
}
