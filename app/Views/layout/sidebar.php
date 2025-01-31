<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= site_url('home') ?>" class="brand-link">
        <img src="<?= base_url('assets/img/logo_apotek.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">Apotek Sumbersekar</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <h6 class="d-block text-white"><?= session()->get('nama_user') ?></h6>
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
                <li class="nav-item">
                    <a href="<?= site_url('home'); ?>" class="nav-link <?= $menu == 'dashboard' ? 'active' : ''; ?>">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">Transaksi</li>
                <li class="nav-item">
                    <a href="<?= site_url('kasir'); ?>" class="nav-link <?= $menu == 'kasir' ? 'active' : ''; ?>">
                        <i class="fas fa-cash-register nav-icon"></i>
                        <p> Penjualan Kasir</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('pembelian'); ?>" class="nav-link <?= $menu == 'pembelian' ? 'active' : ''; ?>">
                        <i class="fas fa-shopping-bag nav-icon"></i>
                        <p> Pembelian Obat</p>
                    </a>
                </li>

                <!-- master data start -->
                <li class="nav-header">Master</li>
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
                        <?php if (session()->get('role') == 'super admin') : ?>
                            <li class="nav-item">
                                <a href="<?= site_url('daftar_user'); ?>" class="nav-link <?= $submenu == 'user' ? 'active' : ''; ?>">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p class="text-capitalize">daftar User</p>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <!-- master data end -->

                <!-- Laporan Start -->
                <li class="nav-header">Laporan</li>
                <li class="nav-item <?= $menu == 'laporan' ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link <?= $menu == 'laporan' ? 'active' : ''; ?>">
                        <i class="fas fa-mail-bulk"></i>
                        <p class="text-capitalize">
                            Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= site_url('laporan_pembelian'); ?>" class="nav-link <?= $submenu == 'pembelian' ? 'active' : ''; ?>">
                                <i class="nav-icon far fa-circle"></i>
                                <p class="text-capitalize">pembelian</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('laporan_transaksi'); ?>" class="nav-link <?= $submenu == 'transaksi' ? 'active' : ''; ?>">
                                <i class="nav-icon far fa-circle"></i>
                                <p class="text-capitalize">transaksi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('laporan_harian'); ?>" class="nav-link <?= $submenu == 'harian' ? 'active' : ''; ?>">
                                <i class="nav-icon far fa-circle"></i>
                                <p class="text-capitalize">harian</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('laporan_bulanan'); ?>" class="nav-link <?= $submenu == 'bulanan' ? 'active' : ''; ?>">
                                <i class="nav-icon far fa-circle"></i>
                                <p class="text-capitalize">bulanan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('laporan_tahunan'); ?>" class="nav-link <?= $submenu == 'tahunan' ? 'active' : ''; ?>">
                                <i class="nav-icon far fa-circle"></i>
                                <p class="text-capitalize">tahunan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('laporan_terlaris'); ?>" class="nav-link <?= $submenu == 'terlaris' ? 'active' : ''; ?>">
                                <i class="nav-icon far fa-circle"></i>
                                <p class="text-capitalize">obat terlaris</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('laporan_menipis'); ?>" class="nav-link <?= $submenu == 'menipis' ? 'active' : ''; ?>">
                                <i class="nav-icon far fa-circle"></i>
                                <p class="text-capitalize">stok menipis</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Laporan End -->

                <?php if (session()->get('role') == 'super admin'): ?>
                    <!-- Setting Start -->
                    <li class="nav-header">Hutang</li>
                    <li class="nav-item">
                        <a href="<?= site_url('/hutang'); ?>" class="nav-link <?= $menu == 'hutang' ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-money-check"></i>
                            <p class="text-capitalize">Hutang</p>
                        </a>
                    </li>
                    <!-- Setting End -->
                <?php endif; ?>

                <!-- Setting Start -->
                <li class="nav-header">Setting</li>
                <li class="nav-item">
                    <a href="<?= site_url('/logout'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p class="text-capitalize">Keluar</p>
                    </a>
                </li>
                <!-- Setting End -->


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>