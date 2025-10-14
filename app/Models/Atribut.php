<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atribut extends Model
{
 
      use HasFactory;
    protected $table = 'atribut';

    protected $guarded = [];
    protected $fillable = [
        'siswa_id',
        'tanggal',
    ];

    public function siswa(){
        return $this->belongsTo(SiswaModel::class, 'siswa_id', 'id');
    }
}
