@extends('l-p-t.m-p')
@section('content')
    {{-- Breadcrumb --}}
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Data Agenda Kehadiran</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ url('/admin') }}">Master Data</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Agenda Kehadiran</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    {{-- Data Jurusan --}}
    <div class="row">
        <div class="col-12">
            <!-- ---------------------
            start Zero Configuration
            ---------------- -->
          <div class="card">
            <div class="card-body">
              <div class="mb-2">
                <h5 class="mb-0">Data Agenda Kehadiran</h5>
              </div>
       

         
                    <div class="table-responsive">
                        <table id="zero_config" class="table border table-bordered text-nowrap align-middle">
                    <thead>
                        <!-- start row -->
                        <tr>
                            <th>No</th>
                            <th>Agenda Kehadiran</th>
                            <th>Tanggal</th>
                            <th>Opsi</th>
                        </tr>
                        <!-- end row -->
                    </thead>
                        <tbody>
                            @foreach ($agendakehadiran as $agenda)
                                <!-- start row -->
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $agenda->nama_agenda }}</td>
                                    <td>
                                        {{ format_tanggal_indo($agenda->tanggal) }}

                                    </td>
                                    <td>
                                        <a href="{{ url('guru/agenda-kehadiran/'.$agenda->id.'/detail') }}" class="btn btn-primary btn-sm"><i class="fa fa-info"></i> Lihat Kehadiran </a>
                                    </td>
                                </tr>
                                <!-- end row -->
                            @endforeach
                        </tbody>
                    </table>
              </div>
            </div>
          </div>
          <!-- ---------------------
                                end Zero Configuration
                            ---------------- -->
        </div>
      </div>

      {!! session('pesan') !!}
      <script>
        $("#zero_config").DataTable();
        $('.edit').click(function () {
            var nama = $(this).data('nama');
            $('input[name=enama]').val(nama);
            $('#form-jurusan').attr('action', $(this).data('url'));
        });

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

@endsection