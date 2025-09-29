<!-- ---------------------------------- -->
<!-- Dashboard -->
<!-- ---------------------------------- -->
<li class="sidebar-item">
    <a class="sidebar-link {{ ($menu == 'dashboard') ? 'active' : ''; }}" href="{{ url('/admin') }}" aria-expanded="false">
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
    <span class="hide-menu">Master Data</span>
</li>
@if(session('role') == 'admin')
<li class="sidebar-item">
    <a class="sidebar-link {{ ($menu == 'profile') ? 'active' : ''; }}" href="{{ url('/admin/profile') }}" aria-expanded="false">
        <span>
            <i class="ti ti-home-2"></i>
        </span>
        <span class="hide-menu">Profile sekolah</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link {{ ($menu == 'jurusan') ? 'active' : ''; }}" href="{{ url('/admin/jurusan') }}" aria-expanded="false">
        <span>
            <i class="ti ti-notebook"></i>
        </span>
        <span class="hide-menu">Jurusan</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link {{ ($menu == 'guru') ? 'active' : ''; }}" href="{{ url('/admin/guru') }}" aria-expanded="false">
        <span>
            <i class="ti ti-book"></i>
        </span>
        <span class="hide-menu">Guru</span>
    </a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link {{ ($menu == 'verificator') ? 'active' : ''; }}" href="{{ url('/admin/verificator') }}" aria-expanded="false">
        <span>
            <i class="ti ti-check"></i>
        </span>
        <span class="hide-menu">Verificator</span>
    </a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link {{ ($menu == 'seksi_presensi') ? 'active' : ''; }}" href="{{ url('/admin/seksi_presensi') }}" aria-expanded="false">
        <span>
            <i class="ti ti-clipboard"></i>
        </span>
        <span class="hide-menu">Seksi Presensi</span>
    </a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link {{ ($menu == 'siswa') ? 'active' : ''; }}" href="{{ url('/admin/siswa') }}" aria-expanded="false">
        <span>
            <i class="ti ti-users"></i>
        </span>
        <span class="hide-menu">Siswa</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link {{ ($menu == 'pendaftaran') ? 'active' : ''; }}" href="{{ url('/admin/pendaftaran') }}" aria-expanded="false">
        <span>
            <i class="ti ti-files"></i>
        </span>
        <span class="hide-menu">Pendaftaran</span>
    </a>
</li>

@endif
