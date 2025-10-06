<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaKehadiran extends Model
{
    use HasFactory;

    protected $table = 'agenda_kehadiran';
     protected $fillable = [
        'nama_agenda',
        'tanggal',
      
    ];

   public function kehadiran()
    {
        return $this->hasMany(DataKehadiran::class, 'agenda_id');
    }



}
