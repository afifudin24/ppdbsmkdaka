@extends('l-p-t.m-p')
@section('content')

    {{-- Breadcrumb --}}
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Data Siswa</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ url('/admin') }}">Master Data</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Siswa</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    {{-- Data Jurusan --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Terjadi kesalahan!</strong>
        <ul class="mt-2 mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                    <div class="mb-2">
                        <h5 class="mb-0">Data Siswa</h5>
                        {{-- filter siswa  --}}
                        <div class="row"> 
                            <div class="col-md-6 my-3">
                                {{-- kasih select option Siswa diterima, menunggu verifikasi dan tidak diterima --}}
                               
<form action="{{ url('/guru/tatausaha/datasiswa') }}" method="GET">
    <div class="form-group">
        <select class="form-control" id="filter" name="filter" onchange="this.form.submit()">
            <option value="">Semua</option>
            <option value="lunas" {{ request('filter') == 'lunas' ? 'selected' : '' }}>Sudah Lunas</option>
            <option value="cicil" {{ request('filter') == 'cicil' ? 'selected' : '' }}>Masih Cicil</option>
            <option value="belum" {{ request('filter') == 'belum' ? 'selected' : '' }}>Belum Bayar</option>
            <option value="atribut" {{ request('filter') == 'atribut' ? 'selected' : '' }}>Sudah Ambil Atribut</option>
        </select>
    </div>
</form>


                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="zero_config" class="table border table-bordered text-nowrap align-middle">
                            <thead>
                                <!-- start row -->
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jurusan</th>
                                    <th>No Regis</th>
                                    <th>Atribut</th>
                                    <th>Opsi</th>
                                </tr>
                                <!-- end row -->
                            </thead>
                          <tbody>
        @foreach ($data_siswa as $siswa)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $siswa->nama }}</td>
                <td>{{ $siswa->jurusan }}</td>
                <td>{{ $siswa->no_regis }}</td>
             <td>
    <input 
        type="checkbox" 
        class="ceklist-atribut" 
        data-id="{{ $siswa->id }}" 
        {{ $siswa->atribut ? 'checked' : '' }}
    >
</td>
                <td>
                    <button
                    data-bs-toggle="modal"
                    data-bs-target="#daftarUlangModal{{ $siswa->id }}"
                    class='btn btn-sm btn-success'><i class="ti ti-plus"></i>Daftar Ulang</button>
                    <!-- Tombol Detail -->
                    <button type="button" class="btn btn-sm btn-primary" 
                        data-bs-toggle="modal" 
                        data-bs-target="#detailModal{{ $siswa->id }}">
                        Detail
                    </button>
                    <!-- modal bs daftar ulang dengan form ke url guru/tatausaha/daftarulang  dengan isian form sesuai id siswa-->
                      <div class="modal fade" id="daftarUlangModal{{ $siswa->id }}" tabindex="-1" aria-labelledby="detailLabel{{ $siswa->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title" id="detailLabel{{ $siswa->id }}">Daftar Ulang Siswa</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('/guru/tatausaha/daftarulang') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $siswa->id }}">
                                        <div class="mb-3">
                                            <label for="nominal" class="form-label">Nominal</label>
                                            <input type="number" name="jumlah" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                           <!-- option status -->
                                            <label for="status" class="form-label">Status</label>
                                            <select name="status" class="form-control" required>
                                                <option value="lunas">Lunas</option>
                                                <option value="cicil">Cicil</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="keterangan" class="form-label">Keterangan</label>
                                            <input type="text" name="keterangan" class="form-control" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>



                    {{-- modal --}}
                        
                        <!-- Modal Detail -->
        <!-- Modal Detail -->
<div class="modal fade" id="detailModal{{ $siswa->id }}" tabindex="-1" aria-labelledby="detailLabel{{ $siswa->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title fw-semibold" id="detailLabel{{ $siswa->id }}">
                    Detail Siswa - {{ $siswa->nama ?? 'Tidak Diketahui' }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body bg-light">
                <div class="row g-3">

                    {{-- ✅ STATUS ATRIBUT --}}
                    <div class="col-md-12">
                        <div class="card shadow-sm border-0">
                            <div class="card-header bg-info text-white fw-semibold">
                                Status Pengambilan Atribut
                            </div>
                            <div class="card-body">
                                @if($siswa->atribut && $siswa->atribut->count() > 0)
                                    @php $atribut = $siswa->atribut->first(); @endphp
                                    <p class="mb-1">
                                        <strong>Tanggal Pengambilan:</strong>
                                        {{ \Carbon\Carbon::parse($atribut->created_at)->translatedFormat('d F Y') }}
                                    </p>
                                    <p class="text-success fw-semibold mb-0">
                                        ✅ Sudah mengambil atribut
                                    </p>
                                @else
                                    <p class="text-danger fw-semibold mb-0">
                                        ❌ Belum mengambil atribut
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- ✅ RIWAYAT DAFTAR ULANG --}}
                    <div class="col-md-12">
                        <div class="card shadow-sm border-0 mt-3">
                            <div class="card-header bg-success text-white fw-semibold">
                                Riwayat Daftar Ulang
                            </div>
                            <div class="card-body">
                                @if($siswa->daftarulang && $siswa->daftarulang->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tanggal</th>
                                                    <th>Nominal</th>
                                                    <th>Status</th>
                                                    <th>Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($siswa->daftarulang as $index => $item)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</td>
                                                        <td>Rp{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                                        <td>
                                                            @if($item->status == 'lunas')
                                                                <span class="badge bg-success">Lunas</span>
                                                            @else
                                                                <span class="badge bg-warning text-dark">Cicil</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $item->keterangan }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-muted fst-italic">
                                        Belum ada riwayat daftar ulang.
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

                    {{-- akhir modal --}}
                 

                    <!-- Tombol Hapus -->
                 
                </td>
            </tr>


        
        @endforeach
    </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

      {!! session('pesan') !!}
      <script>
        $("#zero_config").DataTable();

        $('.hapus').click(function (e) {
            e.preventDefault();
            var tombol_ini = $(this);
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                // confirmButtonColor: "#3085d6",
                // cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Tidak!"
            }).then((result) => {
                if (result.isConfirmed) {
                    tombol_ini.parent('form').submit();
                }
            });
        });
      </script>
      <script>
$(document).on('change', '.ceklist-atribut', function() {
    let siswaId = $(this).data('id');
    let isChecked = $(this).is(':checked') ? 1 : 0;

    $.ajax({
        url: "{{ url('/guru/tatausaha/ceklistatribut') }}/" + siswaId,
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            atribut: isChecked
        },
        success: function(res) {
            console.log('Berhasil update atribut:', res.message);
            // gunakan swal
            Swal.fire({
                icon: res.status ? 'success' : 'error',
                title: res.message
            });

           setTimeout(() => {
    location.reload();
}, 1000);
          
        },
        error: function(xhr) {
            console.error('Gagal update atribut:', xhr.responseText);
            alert('Terjadi kesalahan saat memperbarui data.');
        }
    });
});
</script>

@endsection