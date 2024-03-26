<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-item <?php echo e(Request::is('home') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('home')); ?>" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dasbor</span>
            </a>
        </li>
        <li class="sidebar-item has-sub <?php echo e(Request::is('wargaAsli', 'wargaPendatang') ? 'active' : ''); ?>">
            <a href="#" class="sidebar-link">
                <i class="bi bi-people-fill"></i>
                <span>Data Warga</span>
            </a>
            <ul class="submenu">
                <li class="submenu-item <?php echo e(Request::is('wargaAsli') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('wargaAsli')); ?>" class="submenu-link">Warga Asli</a>
                </li>
                <li class="submenu-item <?php echo e(Request::is('bencana') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('wargaPendatang')); ?>" class="submenu-link">Warga Pendatang</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item  has-sub <?php echo e(Request::is('#') ? 'active' : ''); ?>">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-journal-richtext"></i>
                <span>Data Umum</span>
            </a>
            <ul class="submenu ">
                <li class="submenu-item <?php echo e(Request::is('#') ? 'active' : ''); ?> ">
                    <a href="#" class="submenu-link">Kesehatan</a>
                </li>
                <li class="submenu-item <?php echo e(Request::is('#') ? 'active' : ''); ?> ">
                    <a href="#" class="submenu-link">Pendidikan</a>
                </li>
                <li class="submenu-item <?php echo e(Request::is('#') ? 'active' : ''); ?> ">
                    <a href="#" class="submenu-link">Sosial</a>
                </li>
                <li class="submenu-item <?php echo e(Request::is('#') ? 'active' : ''); ?> ">
                    <a href="#" class="submenu-link">Bencana</a>
                </li>
            </ul>
        </li>
        
        <li class="sidebar-item <?php echo e(Request::is('#') ? 'active' : ''); ?> ">
            <a href="<?php echo e(route('dataKos')); ?>" class='sidebar-link'>
                <i class="bi bi-house-fill"></i>
                <span>Data Kos</span>
            </a>
        </li>
        <li class="sidebar-item <?php echo e(Request::is('#') ? 'active' : ''); ?> ">
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
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="post" style="display: none;">
                <?php echo csrf_field(); ?>
            </form>
        </li>
    </ul>
</div>
<?php /**PATH C:\Users\rudeus\Laravel\pbl-project-sistem-kependudukan\resources\views/includes/sidebar.blade.php ENDPATH**/ ?>