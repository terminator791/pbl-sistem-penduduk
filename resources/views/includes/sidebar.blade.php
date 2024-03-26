<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-item {{ Request::is('home') ? 'active' : '' }}">
            <a href="{{ route('home') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dasbor</span>
            </a>
        </li>
        <li class="sidebar-item has-sub {{ Request::is('wargaAsli', 'wargaPendatang') ? 'active' : '' }}">
            <a href="#" class="sidebar-link">
                <i class="bi bi-people-fill"></i>
                <span>Data Warga</span>
            </a>
            <ul class="submenu">
                <li class="submenu-item {{ Request::is('wargaAsli') ? 'active' : '' }}">
                    <a href="{{ route('wargaAsli') }}" class="submenu-link">Warga Asli</a>
                </li>
                <li class="submenu-item {{ Request::is('bencana') ? 'active' : '' }}">
                    <a href="{{ route('wargaPendatang') }}" class="submenu-link">Warga Pendatang</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item  has-sub {{ Request::is('#') ? 'active' : '' }}">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-journal-richtext"></i>
                <span>Data Umum</span>
            </a>
            <ul class="submenu ">
                <li class="submenu-item {{ Request::is('#') ? 'active' : '' }} ">
                    <a href="#" class="submenu-link">Kesehatan</a>
                </li>
                <li class="submenu-item {{ Request::is('#') ? 'active' : '' }} ">
                    <a href="#" class="submenu-link">Pendidikan</a>
                </li>
                <li class="submenu-item {{ Request::is('#') ? 'active' : '' }} ">
                    <a href="#" class="submenu-link">Sosial</a>
                </li>
                <li class="submenu-item {{ Request::is('#') ? 'active' : '' }} ">
                    <a href="#" class="submenu-link">Bencana</a>
                </li>
            </ul>
        </li>
        {{-- <li class="sidebar-item has-sub {{ Request::is('ekonomi', 'bencana', 'kamtibmas') ? 'active' : '' }}">
            <a href="#" class="sidebar-link">
                <i class="bi bi-pentagon-fill"></i>
                <span>Kewilayahan</span>
            </a>
            <ul class="submenu">
                <li class="submenu-item {{ Request::is('ekonomi') ? 'active' : '' }}">
                    <a href="{{ route('ekonomi') }}" class="submenu-link">Ekonomi</a>
                </li>
                <li class="submenu-item {{ Request::is('bencana') ? 'active' : '' }}">
                    <a href="{{ route('bencana') }}" class="submenu-link">Bencana</a>
                </li>
                <li class="submenu-item {{ Request::is('kamtibmas') ? 'active' : '' }}">
                    <a href="{{ route('kamtibmas') }}" class="submenu-link">Kamtibmas</a>
                </li>
            </ul>
        </li> --}}
        <li class="sidebar-item {{ Request::is('#') ? 'active' : '' }} ">
            <a href="{{ route('dataKos') }}" class='sidebar-link'>
                <i class="bi bi-house-fill"></i>
                <span>Data Kos</span>
            </a>
        </li>
        <li class="sidebar-item {{ Request::is('#') ? 'active' : '' }} ">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-person-fill"></i>
                <span>Profil</span>
            </a>
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
