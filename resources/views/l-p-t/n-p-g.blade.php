<!-- ---------------------------------- -->
<!-- Dashboard -->
<!-- ---------------------------------- -->
<li class="sidebar-item">
    <a class="sidebar-link {{ ($menu == 'dashboard') ? 'active' : ''; }}" href="{{ url('/guru') }}" aria-expanded="false">
        <span>
            <i class="ti ti-home"></i>
        </span>
        <span class="hide-menu">Dashboard</span>
    </a>
</li>
<!-- ---------------------------------- -->
<!-- Master -->
<!-- ---------------------------------- -->
<li class="nav-small-cap">
    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
    <span class="hide-menu">Guru Menu</span>
</li>

<li class="sidebar-item">
    <a class="sidebar-link {{ ($menu == 'siswa') ? 'active' : ''; }}" href="{{ url('/guru/siswa') }}" aria-expanded="false">
        <span>
            <i class="ti ti-user"></i>
        </span>
        <span class="hide-menu">Siswa</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link {{ ($menu == 'daftarkan siswa') ? 'active' : ''; }}" href="{{ url('/guru/daftarkansiswa') }}" aria-expanded="false">
        <span>
            <i class="ti ti-id-badge"></i>
        </span>
        <span class="hide-menu">Daftarkan Siswa</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link {{ ($menu == 'kehadiran') ? 'active' : ''; }}" href="{{ url('/guru/agendakehadiran') }}" aria-expanded="false">
        <span>
            <i class="ti ti-files"></i>
        </span>
        <span class="hide-menu">Kehadiran Siswa</span>
    </a>
</li>


@if(session('user')->verificator)
    {{-- ---------------------------------- --}}
 <li class="nav-small-cap">
    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
    <span class="hide-menu">Verificator Menu</span>
</li>

<li class="sidebar-item">
    <a class="sidebar-link {{ ($menu == 'verifikasi pendaftar') ? 'active' : ''; }}" href="{{ url('/guru/verificator/verifikasi') }}" aria-expanded="false">
        <span>
            <i class="ti ti-check"></i>
        </span>
        <span class="hide-menu">Verifikasi Pendaftar</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link {{ ($menu == 'siswa pendaftar') ? 'active' : ''; }}" href="{{ url('/guru/verificator/siswa') }}" aria-expanded="false">
        <span>
            <i class="ti ti-users"></i>
        </span>
        <span class="hide-menu">Siswa Pendaftar</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link {{ ($menu == 'pendaftaran verificator') ? 'active' : ''; }}" href="{{ url('/guru/verificator/pendaftaran') }}" aria-expanded="false">
        <span>
            <i class="ti ti-files"></i>
        </span>
        <span class="hide-menu">Pendaftaran</span>
    </a>
</li>
@endif




@if(session('user')->seksipresensi)
    {{-- ---------------------------------- --}}
 <li class="nav-small-cap">
    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
    <span class="hide-menu">Seksi Presensi Menu</span>
</li>

<li class="sidebar-item">
    <a class="sidebar-link {{ ($menu == 'presensi kehadiran') ? 'active' : ''; }}" href="{{ url('/guru/seksipresensi/agendakehadiran') }}" aria-expanded="false">
        <span>
            <i class="ti ti-clipboard"></i>
        </span>
        <span class="hide-menu">Presensi Kehadiran</span>
    </a>
</li>

@endif