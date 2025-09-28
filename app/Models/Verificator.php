<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verificator extends Model
{
    use HasFactory;
    protected $table = 'verificator';

    public function guru()
{
    return $this->belongsTo(Guru::class, 'guru_id');
}
}
