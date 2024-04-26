<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-item {{ Request::is('home') ? 'active' : '' }}">
            <a href="{{ route('home') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dasbor</span>
            </a>
        </li>
        <li class="sidebar-item has-sub {{ Request::is('wargaAsli', 'wargaPendatang') ? 'active open' : '' }}">
            <a href="#" class="sidebar-link">
                <i class="bi bi-people-fill"></i>
                <span>Data Warga</span>
            </a>
            <ul class="submenu" style="{{ Request::is('wargaAsli', 'wargaPendatang') ? 'display: block;' : '' }}">
                <li class="submenu-item {{ Request::is('wargaAsli') ? 'active' : '' }}">
                    <a href="{{ route('wargaAsli') }}" class="submenu-link">Warga Asli</a>
                </li>
                <li class="submenu-item {{ Request::is('wargaPendatang') ? 'active' : '' }}">
                    <a href="{{ route('wargaPendatang') }}" class="submenu-link">Warga Pendatang</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item  has-sub {{ Request::is('kesehatan', 'pendidikan', 'bantuan', 'kejadian') ? 'active open' : '' }}">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-journal-richtext"></i>
                <span>Data Umum</span>
            </a>
            <ul class="submenu" style="{{ Request::is('kesehatan', 'pendidikan', 'bantuan', 'kejadian') ? 'display: block;' : '' }}">
                <li class="submenu-item {{ Request::is('kesehatan') ? 'active' : '' }} ">
                    <a href="{{ route('kesehatan') }}" class="submenu-link">Kesehatan</a>
                </li>
                <li class="submenu-item {{ Request::is('pendidikan') ? 'active' : '' }} ">
                    <a href="{{ route('pendidikan') }}" class="submenu-link">Pendidikan</a>
                </li>
                <li class="submenu-item {{ Request::is('bantuan') ? 'active' : '' }} ">
                    <a href="{{ route('bantuan') }}" class="submenu-link">Sosial</a>
                </li>
                <li class="submenu-item {{ Request::is('kejadian') ? 'active' : '' }} ">
                    <a href="{{ route('kejadian') }}" class="submenu-link">Bencana</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item {{ Request::is('dataKos') ? 'active' : '' }} ">
            <a href="{{ route('dataKos') }}" class='sidebar-link'>
                <i class="bi bi-house-fill"></i>
                <span>Data Kos</span>
            </a>
        </li>
        <li class="sidebar-item has-sub {{ Request::is('profile') ? 'active' : '' }} ">
            <a href="{{route('profile')}}" class='sidebar-link'>
                <i class="bi bi-person-fill"></i>
                <span>Profil</span>
            </a>
            <ul class="submenu" style="{{ Request::is('profile', 'wargaPendatang') ? 'display: block;' : '' }}">
                <li class="submenu-item {{ Request::is('profile') ? 'active' : '' }}">
                    <a href="{{ route('profile') }}" class="submenu-link">Profile</a>
                </li>
                <li class="submenu-item {{ Request::is('wargaPendatang') ? 'active' : '' }}">
                    <a href="{{ route('profile.create') }}" class="submenu-link">Tambah User</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item  ">
            <a href="#" class='sidebar-link'
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                <span>Keluar</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</div>
