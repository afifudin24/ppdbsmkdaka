<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKehadiran extends Model
{
    use HasFactory;

    protected $table = 'data_kehadiran';

    protected $guarded = ['id'];
    protected $fillable = [
        'siswa_id',
        'agenda_id',
        'status_kehadiran',
    ];

 public function agenda()
    {
        return $this->belongsTo(AgendaKehadiran::class, 'agenda_id');
    }

    public function siswa()
    {
        return $this->belongsTo(SiswaModel::class, 'siswa_id');
    }
}
