<?php

namespace App\Http\Controllers;

use App\Models\ProfileSekolahModel;
use App\Models\SiswaModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login', [
            'sekolah' => ProfileSekolahModel::first()
        ]);
    }



public function login(Request $request)
{
   
   
    $user = User::where('username', $request->username)->first();

    if ($user) {
        // cek password
        if (Hash::check($request->password, $user->password)) {
            // simpan session
            $request->session()->put('id', $user->id);
            $request->session()->put('role', $user->role);

            // arahkan sesuai role
            if ($user->role === 'siswa') {
                return redirect('/siswa')->with('pesan', $this->swal('Berhasil', 'Berhasil login sebagai Siswa', 'success'));
            } elseif ($user->role === 'guru') {
                return redirect('/guru')->with('pesan', $this->swal('Berhasil', 'Berhasil login sebagai Guru', 'success'));
            } elseif ($user->role === 'admin') {
                return redirect('/admin')->with('pesan', $this->swal('Berhasil', 'Berhasil login sebagai Admin', 'success'));
            }
        } else {
            // password salah
            return redirect('/auth')->with('pesan', $this->swal('Error', 'Password salah', 'error'));
        }
    }

    // user tidak ditemukan
    return redirect('/auth')->with('pesan', $this->swal('Error', 'Akun tidak ada', 'error'));
}

/**
 * Helper untuk swal alert
 */
private function swal($title, $text, $icon)
{
    return "
        <script>
            Swal.fire({
                title: '{$title}',
                text: '{$text}',
                icon: '{$icon}',
            });
        </script>
    ";
}

    public function daftar()
    {
        return view('auth.daftar', [
            'sekolah' => ProfileSekolahModel::first()
        ]);
    }
    public function store(Request $request)
    {
        $data = [
            'no_regis' => date('dmy', time()) . random_int(0, 9999999),
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password,
            'foto' => 'default.png'
        ];

        SiswaModel::create($data);

        return redirect('/auth')->with('pesan', "
            <script>
                Swal.fire(
                    {
                        title: 'Berhasil',
                        text: 'Akun dibuat, silahkan log in',
                        icon: 'success',
                    }
                );
            </script>
        ");
    }
    public function logout()
    {
        session()->forget('id');
        session()->forget('role');

        return redirect('/')->with('pesan', "
            <script>
                Swal.fire(
                    {
                        title: 'Berhasil',
                        text: 'Anda sudah logout',
                        icon: 'success',
                    }
                );
            </script>
        ");
    }
}
