<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranModel extends Model
{
    use HasFactory;
    public $table = 'pendaftaran';
    protected $guarded = ['id'];

    public function detail_pendaftaran() {
        return $this->hasMany(PendaftaranDetailModel::class, 'pendaftaran_id', 'id');
    }
}
