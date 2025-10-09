@extends('l-p-t.m-p')
@section('content')
    {{-- Breadcrumb --}}
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Presensi QR Code</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ url('/guru') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Presensi QR</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

       {{-- QR Scanner Section --}}
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="fw-semibold mb-3">Scan QR Code Siswa</h5>
                    <div id="reader" style="width: 100%; max-width: 350px; margin: 0 auto;"></div>
                </div>
            </div>
        </div>

        {{-- Form Data Siswa --}}
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="fw-semibold mb-3">Data Siswa</h5>
                    <form id="form-presensi">
                        <div class="mb-3">
                            <label for="id_siswa" class="form-label">ID Siswa</label>
                            <input type="text" id="id_siswa" name="id_siswa" class="form-control" readonly>
                        </div>

                        <input type="text" name="agenda_id" value="{{ $agendakehadiran->id }}" hidden>

                        <div class="mb-3">
                            <label for="no_registrasi" class="form-label">No Registrasi</label>
                            <input type="text" id="no_registrasi" name="no_registrasi" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" id="nama" name="nama" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                            <input type="text" id="asal_sekolah" name="asal_sekolah" class="form-control" readonly>
                        </div>

                        <div class="d-grid">
                            <button type="button" id="btnSimpanPresensi" class="btn btn-success">
                                <i class="fa fa-check"></i> Simpan Presensi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {!! session('pesan') !!}

    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
          let html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 30, qrbox: 200 });
        function stopScanning() {
        // clear() akan menghentikan kamera dan membersihkan tampilan scanner
        html5QrcodeScanner.clear().then(() => {
            console.log("Scanning stopped.");
        }).catch(err => {
            console.error("Gagal menghentikan scanner:", err);
        });
    }

        function onScanSuccess(decodedText, decodedResult) {
            try {
                let data = JSON.parse(decodedText);
                document.getElementById('id_siswa').value = data.id;
                document.getElementById('no_registrasi').value = data.no_registrasi;
                document.getElementById('nama').value = data.nama;
                document.getElementById('asal_sekolah').value = data.asal_sekolah;
                
            Swal.fire({
                icon: 'success',
                title: 'QR Berhasil Dipindai!',
                text: `Data siswa: ${data.nama}`,
                timer: 2000,
                showConfirmButton: false
            });



            } catch (e) {
                console.log(e)
                Swal.fire({
                    icon: 'error',
                    title: 'QR Code tidak valid!',
                    text: 'Pastikan QR Code berisi data siswa dalam format JSON yang benar.'
                });
            }
        }

      
        html5QrcodeScanner.render(onScanSuccess);
        
 // Tunggu tombol muncul
setTimeout(() => {
    // Style tombol Start Scanning
    const startBtn = document.querySelector('#reader button');
    if (startBtn) {
        startBtn.classList.add('btn', 'btn-success', 'px-3', 'mt-3');
        startBtn.style.fontWeight = '600';
        startBtn.innerHTML = '<i class="ti-control-play"></i> Start Scanning';
    }

    // Cek tombol Stop setiap 300ms
    const checkStopBtn = setInterval(() => {
        const stopBtn = document.querySelector('#html5-qrcode-button-camera-stop');
        if (stopBtn) {
            stopBtn.classList.add('btn', 'btn-danger', 'px-3', 'mt-3');
            stopBtn.style.fontWeight = '600';
            stopBtn.innerHTML = '<i class="ti-control-pause"></i> Stop Scanning';

            clearInterval(checkStopBtn); // Hentikan interval setelah ketemu
        }
    }, 300);
}, 500);

        // Simpan Presensi (bisa disesuaikan ke endpoint Laravel kamu)
        document.getElementById('btnSimpanPresensi').addEventListener('click', function() {
            const idSiswa = document.getElementById('id_siswa').value;
            if (!idSiswa) {
                Swal.fire('Peringatan', 'Scan QR Code terlebih dahulu!', 'warning');
                return;
            }

            // Contoh kirim data via AJAX ke route Laravel
            fetch('{{ url("guru/presensi/simpan") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    id_siswa: idSiswa,
                    no_registrasi: document.getElementById('no_registrasi').value,
                    nama: document.getElementById('nama').value,
                    asal_sekolah: document.getElementById('asal_sekolah').value
                })
            })
            .then(res => res.json())
            .then(data => {
                Swal.fire({
                    icon: data.status ? 'success' : 'error',
                    title: data.message
                });
            })
            .catch(() => {
                Swal.fire('Error', 'Terjadi kesalahan saat menyimpan data.', 'error');
            });
        });
    </script>

    
<style>
    #btnStartScan, #btnStopScan {
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        transition: 0.3s ease;
    }

    #btnStartScan {
        background-color: #198754; /* hijau */
        color: white;
    }

    #btnStartScan:hover {
        background-color: #157347;
    }

    #btnStopScan {
        background-color: #dc3545; /* merah */
        color: white;
    }

    #btnStopScan:hover {
        background-color: #bb2d3b;
    }
</style>
@endsection
