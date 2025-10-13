<!-- ---------------------------------- -->
<!-- Dashboard -->
<!-- ---------------------------------- -->
<li class="sidebar-item">
    <a class="sidebar-link {{ ($menu == 'dashboard') ? 'active' : ''; }}" href="{{ url('/siswa') }}" aria-expanded="false">
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
    <span class="hide-menu">Siswa Menu</span>
</li>

<li class="sidebar-item">
    <a class="sidebar-link {{ ($menu == 'profile') ? 'active' : ''; }}" href="{{ url('/siswa/profile') }}" aria-expanded="false">
        <span>
            <i class="ti ti-user"></i>
        </span>
        <span class="hide-menu">Profile</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link {{ ($menu == 'data diri') ? 'active' : ''; }}" href="{{ url('/siswa/datadiri') }}" aria-expanded="false">
        <span>
            <i class="ti ti-user"></i>
        </span>
        <span class="hide-menu">Data Diri</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link {{ ($menu == 'pendaftaran') ? 'active' : ''; }}" href="{{ url('/siswa/pendaftaran') }}" aria-expanded="false">
        <span>
            <i class="ti ti-files"></i>
        </span>
        <span class="hide-menu">Pendaftaran</span>
    </a>
</li>

