<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Auth
$routes->get('/', 'AuthController::index');
$routes->post('/proses_login', 'AuthController::proses_login');
$routes->get('/register', 'AuthController::register');
$routes->post('/proses_register', 'AuthController::proses_register');
$routes->get('verify-email/(:any)', 'AuthController::verifyEmail/$1');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/lupa_password', 'AuthController::lupa_password');
$routes->post('proses-lupa-password', 'AuthController::proses_lupa_password');
$routes->get('reset-password/(:segment)', 'AuthController::reset_password/$1');
$routes->post('proses-reset-password', 'AuthController::proses_reset_password');
$routes->get('kirim-ulang-konfirmasi/(:num)', 'AuthController::kirim_ulang_konfirmasi/$1');
$routes->get('konfirmasi-email/(:segment)', 'AuthController::konfirmasi_email/$1');
$routes->get('/recover_password', 'AuthController::recover_password');

//pages
$routes->get('/home', 'PagesController::home', ['filter' => 'AuthFilter']);

//kasir
$routes->get('/kasir', 'PagesController::kasir', ['filter' => 'AuthFilter']);
$routes->post('/cekObat', 'PagesController::cekObat', ['filter' => 'AuthFilter']);
$routes->post('/dataDetail', 'PagesController::dataDetail', ['filter' => 'AuthFilter']);
$routes->post('/listDataObat', 'PagesController::listDataObat', ['filter' => 'AuthFilter']);
$routes->post('/simpanTemp', 'PagesController::simpanTemp', ['filter' => 'AuthFilter']);
$routes->post('/hitungTotalBayar', 'PagesController::hitungTotalBayar', ['filter' => 'AuthFilter']);
$routes->post('/hapusItem', 'PagesController::hapusItem', ['filter' => 'AuthFilter']);
$routes->post('/batalTransaksi', 'PagesController::batalTransaksi', ['filter' => 'AuthFilter']);
$routes->post('/pembayaran', 'PagesController::pembayaran', ['filter' => 'AuthFilter']);
$routes->post('/simpanPembayaran', 'PagesController::simpanPembayaran', ['filter' => 'AuthFilter']);
$routes->get('/autofill', 'PagesController::autofill', ['filter' => 'AuthFilter']);
$routes->post('/autofill', 'PagesController::autofill', ['filter' => 'AuthFilter']);
$routes->post('/cetakStruk', 'PagesController::cetakStruk', ['filter' => 'AuthFilter']);
$routes->get('/printStruk/(:any)', 'PagesController::printStruk/$1', ['filter' => 'AuthFilter']);


// pembelian
$routes->get('/pembelian', 'PembelianController::pembelian', ['filter' => 'AuthFilter']);
$routes->get('/autofillPembelian', 'PembelianController::autofillPembelian', ['filter' => 'AuthFilter']);
$routes->post('/autofillPembelian', 'PembelianController::autofillPembelian', ['filter' => 'AuthFilter']);
$routes->post('/dataDetailPembelian', 'PembelianController::dataDetailPembelian', ['filter' => 'AuthFilter']);
$routes->post('/simpanTempPembelian', 'PembelianController::simpanTempPembelian', ['filter' => 'AuthFilter']);
$routes->post('/hitungTotalBeli', 'PembelianController::hitungTotalBeli', ['filter' => 'AuthFilter']);
$routes->post('/hapusItemBeli', 'PembelianController::hapusItemBeli', ['filter' => 'AuthFilter']);
$routes->post('/batalPembelian', 'PembelianController::batalPembelian', ['filter' => 'AuthFilter']);
$routes->post('/simpanPembelian', 'PembelianController::simpanPembelian', ['filter' => 'AuthFilter']);
$routes->get('/editItemBeli', 'PembelianController::editItemBeli', ['filter' => 'AuthFilter']);
$routes->post('/editItemBeli', 'PembelianController::editItemBeli', ['filter' => 'AuthFilter']);

//laporan
$routes->get('/laporan_pembelian', 'LaporanController::laporan_pembelian', ['filter' => 'AuthFilter']);
$routes->get('/laporan_harian', 'LaporanController::laporan_harian', ['filter' => 'AuthFilter']);
$routes->get('/laporan_bulanan', 'LaporanController::laporan_bulanan', ['filter' => 'AuthFilter']);
$routes->get('/laporan_tahunan', 'LaporanController::laporan_tahunan', ['filter' => 'AuthFilter']);
$routes->get('/laporan_transaksi', 'LaporanController::laporan_transaksi', ['filter' => 'AuthFilter']);
$routes->post('/laporan_transaksi', 'LaporanController::laporan_transaksi', ['filter' => 'AuthFilter']);
$routes->get('/laporan_terlaris', 'LaporanController::laporan_terlaris', ['filter' => 'AuthFilter']);
$routes->get('/laporan_menipis', 'LaporanController::laporan_menipis', ['filter' => 'AuthFilter']);
$routes->get('/laporan_tahunan', 'LaporanController::laporan_tahunan', ['filter' => 'AuthFilter']);
$routes->get('/invoice/(:segment)', 'LaporanController::invoice/$1', ['filter' => 'AuthFilter']);
$routes->get('/print/(:segment)', 'LaporanController::print/$1', ['filter' => 'AuthFilter']);
$routes->get('/editTransaksi/(:any)', 'LaporanController::editTransaksi/$1', ['filter' => 'AuthFilter']);
$routes->get('edit_detail_transaksi/(:num)', 'LaporanController::edit_detail_transaksi/$1', ['filter' => 'AuthFilter']);
$routes->post('/simpanTransaksi', 'LaporanController::simpanTransaksi', ['filter' => 'AuthFilter']);
$routes->post('/hapusTransaksi', 'LaporanController::hapusTransaksi', ['filter' => 'AuthFilter']);
$routes->get('/editPembelian/(:any)', 'LaporanController::editPembelian/$1', ['filter' => 'AuthFilter']);
$routes->get('edit_detail_pembelian/(:num)', 'LaporanController::edit_detail_pembelian/$1', ['filter' => 'AuthFilter']);
$routes->post('/updatePembelian', 'LaporanController::updatePembelian', ['filter' => 'AuthFilter']);
$routes->post('/hapusPembelian', 'LaporanController::hapusPembelian', ['filter' => 'AuthFilter']);
$routes->get('exportpdf_bulanan', 'LaporanController::exportpdf_bulanan', ['filter' => 'AuthFilter']);
$routes->get('exportpdf_tahunan', 'LaporanController::exportpdf_tahunan', ['filter' => 'AuthFilter']);

// hutang
$routes->get('/hutang', 'HutangController::hutang', ['filter' => 'AuthFilter']);
$routes->post('/tambah_hutang', 'HutangController::tambah_hutang');
$routes->post('/hutang/markAsPaid', 'HutangController::markAsPaid');
$routes->post('/hutang/delete', 'HutangController::delete');
$routes->get('/editHutang/(:any)', 'HutangController::editHutang/$1');
$routes->post('/updateHutang', 'HutangController::updateHutang');

//obat
$routes->get('/daftar_obat', 'ObatController::daftar_obat', ['filter' => 'AuthFilter']);
$routes->get('/create_obat', 'ObatController::create_obat', ['filter' => 'AuthFilter']);
$routes->post('/tambah_obat', 'ObatController::tambah_obat', ['filter' => 'AuthFilter']);
$routes->get('/edit_obat/(:num)', 'ObatController::edit_obat/$1', ['filter' => 'AuthFilter']);
$routes->post('/update/(:num)', 'ObatController::update/$1', ['filter' => 'AuthFilter']);
$routes->get('/delete_obat/(:num)', 'ObatController::delete_obat/$1', ['filter' => 'AuthFilter']);
$routes->post('/tambahObat', 'ObatController::tambahObat', ['filter' => 'AuthFilter']);
$routes->post('/simpanObat', 'ObatController::simpanObat', ['filter' => 'AuthFilter']);
$routes->post('/addGolongan', 'ObatController::addGolongan', ['filter' => 'AuthFilter']);

$routes->get('/exportExcel', 'ObatController::exportExcel', ['filter' => 'AuthFilter']);
$routes->get('import_obat', 'ObatController::importExcel');
$routes->post('process_import_obat', 'ObatController::processImport');
$routes->get('download_template', 'ObatController::templateExcel');

//Kategori
$routes->get('/daftar_kategori', 'KategoriController::daftar_kategori', ['filter' => 'AuthFilter']);
$routes->post('/tambah_kategori', 'KategoriController::tambah_kategori', ['filter' => 'AuthFilter']);
$routes->post('/edit_kategori/(:num)', 'KategoriController::edit_kategori/$1', ['filter' => 'AuthFilter']);
$routes->get('/delete_kategori/(:num)', 'KategoriController::delete_kategori/$1', ['filter' => 'AuthFilter']);
$routes->post('/tambahKategori', 'KategoriController::tambahKategori', ['filter' => 'AuthFilter']);
$routes->post('/simpanKategori', 'KategoriController::simpanKategori', ['filter' => 'AuthFilter']);

// Golongan
$routes->get('/daftar_golongan', 'GolonganController::daftar_golongan', ['filter' => 'AuthFilter']);
$routes->post('/tambah_golongan', 'GolonganController::tambah_golongan', ['filter' => 'AuthFilter']);
$routes->post('/edit_golongan/(:num)', 'GolonganController::edit_golongan/$1', ['filter' => 'AuthFilter']);
$routes->get('/delete_golongan/(:num)', 'GolonganController::delete_golongan/$1', ['filter' => 'AuthFilter']);
$routes->post('/tambahGolongan', 'GolonganController::tambahGolongan', ['filter' => 'AuthFilter']);
$routes->post('/simpanGolongan', 'GolonganController::simpanGolongan', ['filter' => 'AuthFilter']);

// Satuan
$routes->get('/daftar_satuan', 'SatuanController::daftar_satuan', ['filter' => 'AuthFilter']);
$routes->post('/tambah_satuan', 'SatuanController::tambah_satuan', ['filter' => 'AuthFilter']);
$routes->post('/edit_satuan/(:num)', 'SatuanController::edit_satuan/$1', ['filter' => 'AuthFilter']);
$routes->get('/delete_satuan/(:num)', 'SatuanController::delete_satuan/$1', ['filter' => 'AuthFilter']);
$routes->post('/tambahSatuan', 'SatuanController::tambahSatuan', ['filter' => 'AuthFilter']);
$routes->post('/simpanSatuan', 'SatuanController::simpanSatuan', ['filter' => 'AuthFilter']);

// Etiket
$routes->get('/daftar_etiket', 'EtiketController::daftar_etiket', ['filter' => 'AuthFilter']);
$routes->post('/tambah_etiket', 'EtiketController::tambah_etiket', ['filter' => 'AuthFilter']);
$routes->post('/edit_etiket/(:num)', 'EtiketController::edit_etiket/$1', ['filter' => 'AuthFilter']);
$routes->get('/delete_etiket/(:num)', 'EtiketController::delete_etiket/$1', ['filter' => 'AuthFilter']);
$routes->post('/tambahEtiket', 'EtiketController::tambahEtiket', ['filter' => 'AuthFilter']);
$routes->post('/simpanEtiket', 'EtiketController::simpanEtiket', ['filter' => 'AuthFilter']);

// Supplier
$routes->get('/daftar_supplier', 'SupplierController::daftar_supplier', ['filter' => 'AuthFilter']);
$routes->post('/tambah_supplier', 'SupplierController::tambah_supplier', ['filter' => 'AuthFilter']);
$routes->post('/edit_supplier/(:num)', 'SupplierController::edit_supplier/$1', ['filter' => 'AuthFilter']);
$routes->get('/delete_supplier/(:num)', 'SupplierController::delete_supplier/$1', ['filter' => 'AuthFilter']);
$routes->post('/tambahSupplier', 'SupplierController::tambahSupplier', ['filter' => 'AuthFilter']);
$routes->post('/simpanSupplier', 'SupplierController::simpanSupplier', ['filter' => 'AuthFilter']);

// Pabrik
$routes->get('/daftar_pabrik', 'PabrikController::daftar_pabrik', ['filter' => 'AuthFilter']);
$routes->post('/tambah_pabrik', 'PabrikController::tambah_pabrik', ['filter' => 'AuthFilter']);
$routes->post('/edit_pabrik/(:num)', 'PabrikController::edit_pabrik/$1', ['filter' => 'AuthFilter']);
$routes->get('/delete_pabrik/(:num)', 'PabrikController::delete_pabrik/$1', ['filter' => 'AuthFilter']);

// user
$routes->get('/daftar_user', 'UserController::daftar_user', ['filter' => 'AuthFilter']);
$routes->post('/edit_user/(:num)', 'UserController::edit_user/$1', ['filter' => 'AuthFilter']);
$routes->get('/delete_user/(:num)', 'UserController::delete_user/$1', ['filter' => 'AuthFilter']);
