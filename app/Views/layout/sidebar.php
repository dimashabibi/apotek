<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= site_url('home') ?>" class="brand-link">
        <img src="<?= base_url('assets/img/AdminLTELogo.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Apotek Sumbersekar</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets/img/user2-160x160.jpg'); ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= session()->get('username') ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="<?= site_url('home'); ?>" class="nav-link <?= $menu == 'dashboard' ? 'active' : ''; ?>">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('kasir'); ?>" class="nav-link <?= $menu == 'kasir' ? 'active' : ''; ?>">
                        <i class="fas fa-cash-register nav-icon"></i>
                        <p> Penjualan Kasir</p>
                    </a>
                </li>


                <li class="nav-item <?= $menu == 'master_data' ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link <?= $menu == 'master_data' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p class="text-capitalize">
                            Master Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= site_url('daftar_obat'); ?>" class="nav-link <?= $submenu == 'obat' ? 'active' : ''; ?>">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Daftar Obat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('daftar_kategori'); ?>" class="nav-link <?= $submenu == 'kategori' ? 'active' : ''; ?>">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Daftar Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('daftar_golongan'); ?>" class="nav-link <?= $submenu == 'golongan' ? 'active' : ''; ?>">
                                <i class="nav-icon far fa-circle"></i>
                                <p class="text-capitalize">daftar golongan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('daftar_satuan'); ?>" class="nav-link <?= $submenu == 'satuan' ? 'active' : ''; ?>">
                                <i class="nav-icon far fa-circle"></i>
                                <p class="text-capitalize">daftar satuan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('daftar_etiket'); ?>" class="nav-link <?= $submenu == 'etiket' ? 'active' : ''; ?>">
                                <i class="nav-icon far fa-circle"></i>
                                <p class="text-capitalize">daftar etiket</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('daftar_supplier'); ?>" class="nav-link <?= $submenu == 'supplier' ? 'active' : ''; ?>">
                                <i class="nav-icon far fa-circle"></i>
                                <p class="text-capitalize">daftar supplier</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('daftar_pabrik'); ?>" class="nav-link <?= $submenu == 'pabrik' ? 'active' : ''; ?>">
                                <i class="nav-icon far fa-circle"></i>
                                <p class="text-capitalize">daftar pabrik</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>