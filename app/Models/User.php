<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    public function admin()
    {
        return $this->hasOne(Admin::class, 'user_id');
    }
    public function guru()
    {
        return $this->hasOne(Guru::class, 'user_id');
    }

    public function siswa()
{
    return $this->hasOne(SiswaModel::class, 'user_id');
}
}
