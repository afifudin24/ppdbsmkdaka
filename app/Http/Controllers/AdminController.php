<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranDetailModel;
use App\Models\PendaftaranModel;
use App\Models\ProfileSekolahModel;
use App\Models\SiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {

        $total_lulus = PendaftaranDetailModel::where('status', 1)->get();
        $total_tidak_lulus = PendaftaranDetailModel::where('status', 2)->get();

        return view('admin.index', [
            'plugins' => '',
            'menu_master' => 'false',
            'menu' => 'dashboard',
            'judul' => 'Dashboard',
            'sekolah' => ProfileSekolahModel::first(),
            'data_siswa' => SiswaModel::all(),
            'data_pendaftaran' => PendaftaranModel::all(),
            'total_lulus' => $total_lulus,
            'total_tidak_lulus' => $total_tidak_lulus,
        ]);
    }

    public function profile()
    {
        // dd(ProfileSekolahModel::first());
        return view('admin.profile', [
            'plugins' => '',
            'menu_master' => 'false',
            'menu' => 'profile',
            'judul' => 'Profile Sekolah',
            'sekolah' => ProfileSekolahModel::first(),
        ]);
    }

    public function profile_foto(Request $request)
    {
        if ($request->file('foto')) {
            if ($request->foto_lama) {
                if ($request->foto_lama != 'favicon.png') {
                    Storage::delete('assets/files/' . $request->foto_lama);
                }
            }
            $data['foto'] = str_replace('assets/files/', '', $request->file('foto')->store('assets/files'));
        }

        ProfileSekolahModel::where('id', $request->id)
            ->update($data);
        return redirect('/admin/profile')->with('pesan', "
            <script>
                Swal.fire(
                    {
                        title: 'Berhasil',
                        text: 'Logo di edit',
                        icon: 'success',
                    }
                );
            </script>
        ");
    }

    public function profile_akun(Request $request)
    {
        $data = [
            'username' => $request->username,
            'password' => $request->password
        ];

        ProfileSekolahModel::where('id', $request->id)
            ->update($data);

        return redirect('/admin/profile')->with('pesan', "
            <script>
                Swal.fire(
                    {
                        title: 'Berhasil',
                        text: 'Akun di edit',
                        icon: 'success',
                    }
                );
            </script>
        ");
    }
    public function profile_info(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'kepsek' => $request->kepsek,
            'nip_kepsek' => $request->nip_kepsek,
            'ttd_kepsek' => $request->ttd_kepsek_lama,
            'panitia' => $request->panitia,
            'nip_panitia' => $request->nip_panitia,
            'ttd_panitia' => $request->ttd_panitia_lama,
            'logo_dark' => $request->logo_dark_lama,
            'alamat' => $request->alamat,
            'telpon' => $request->telpon,
            'website' => $request->website,
            'email' => $request->email,
        ];

        if ($request->file('ttd_kepsek')) {
            if ($request->ttd_kepsek_lama) {
                Storage::delete('assets/files/' . $request->ttd_kepsek_lama);
            }
            $data['ttd_kepsek'] = str_replace('assets/files/', '', $request->file('ttd_kepsek')->store('assets/files'));
        }

        if ($request->file('ttd_panitia')) {
            if ($request->ttd_panitia_lama) {
                Storage::delete('assets/files/' . $request->ttd_panitia_lama);
            }
            $data['ttd_panitia'] = str_replace('assets/files/', '', $request->file('ttd_panitia')->store('assets/files'));
        }

        if ($request->file('logo_dark')) {
            if ($request->logo_dark_lama) {
                Storage::delete('assets/files/' . $request->logo_dark_lama);
            }
            $data['logo_dark'] = str_replace('assets/files/', '', $request->file('logo_dark')->store('assets/files'));
        }


        ProfileSekolahModel::where('id', $request->id)
            ->update($data);

        return redirect('/admin/profile')->with('pesan', "
            <script>
                Swal.fire(
                    {
                        title: 'Berhasil',
                        text: 'Profile sekolah di edit',
                        icon: 'success',
                    }
                );
            </script>
        ");
    }
}
