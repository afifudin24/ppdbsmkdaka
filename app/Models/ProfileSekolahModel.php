<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileSekolahModel extends Model
{
    use HasFactory;
    public $table = 'profile_sekolah';
    public $timestamps = false;
    protected $guarded = ['id'];
}
