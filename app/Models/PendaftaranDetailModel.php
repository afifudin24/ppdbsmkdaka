<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranDetailModel extends Model
{
    use HasFactory;
    public $table = 'pendaftaran_detail';
    protected $guarded = ['id'];

    public function pendaftaran()
    {
        return $this->belongsTo(PendaftaranModel::class);
    }
    public function siswa()
    {
        return $this->belongsTo(SiswaModel::class);
    }
}
