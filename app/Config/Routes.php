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
$routes->get('/logout', 'AuthController::logout');

//pages
$routes->get('/home', 'PagesController::home', ['filter' => 'AuthFilter']);
$routes->get('/kasir', 'PagesController::kasir', ['filter' => 'AuthFilter']);
$routes->get('/cekObat', 'PagesController::cekObat', ['filter' => 'AuthFilter']);
$routes->post('/dataDetail', 'PagesController::dataDetail', ['filter' => 'AuthFilter']);


//obat
$routes->get('/daftar_obat', 'ObatController::daftar_obat', ['filter' => 'AuthFilter']);
$routes->get('/create_obat', 'ObatController::create_obat', ['filter' => 'AuthFilter']);
$routes->post('/tambah_obat', 'ObatController::tambah_obat', ['filter' => 'AuthFilter']);
$routes->get('/edit_obat/(:num)', 'ObatController::edit_obat/$1', ['filter' => 'AuthFilter']);
$routes->post('/update/(:num)', 'ObatController::update/$1', ['filter' => 'AuthFilter']);
$routes->get('/delete_obat/(:num)', 'ObatController::delete_obat/$1', ['filter' => 'AuthFilter']);

$routes->post('/addGolongan', 'ObatController::addGolongan', ['filter' => 'AuthFilter']);

//Kategori
$routes->get('/daftar_kategori', 'KategoriController::daftar_kategori', ['filter' => 'AuthFilter']);
$routes->post('/tambah_kategori', 'KategoriController::tambah_kategori', ['filter' => 'AuthFilter']);
$routes->post('/edit_kategori/(:num)', 'KategoriController::edit_kategori/$1', ['filter' => 'AuthFilter']);
$routes->get('/delete_kategori/(:num)', 'KategoriController::delete_kategori/$1', ['filter' => 'AuthFilter']);

// Golongan
$routes->get('/daftar_golongan', 'GolonganController::daftar_golongan', ['filter' => 'AuthFilter']);
$routes->post('/tambah_golongan', 'GolonganController::tambah_golongan', ['filter' => 'AuthFilter']);
$routes->post('/edit_golongan/(:num)', 'GolonganController::edit_golongan/$1', ['filter' => 'AuthFilter']);
$routes->get('/delete_golongan/(:num)', 'GolonganController::delete_golongan/$1', ['filter' => 'AuthFilter']);

// Satuan
$routes->get('/daftar_satuan', 'SatuanController::daftar_satuan', ['filter' => 'AuthFilter']);
$routes->post('/tambah_satuan', 'SatuanController::tambah_satuan', ['filter' => 'AuthFilter']);
$routes->post('/edit_satuan/(:num)', 'SatuanController::edit_satuan/$1', ['filter' => 'AuthFilter']);
$routes->get('/delete_satuan/(:num)', 'SatuanController::delete_satuan/$1', ['filter' => 'AuthFilter']);

// Etiket
$routes->get('/daftar_etiket', 'EtiketController::daftar_etiket', ['filter' => 'AuthFilter']);
$routes->post('/tambah_etiket', 'EtiketController::tambah_etiket', ['filter' => 'AuthFilter']);
$routes->post('/edit_etiket/(:num)', 'EtiketController::edit_etiket/$1', ['filter' => 'AuthFilter']);
$routes->get('/delete_etiket/(:num)', 'EtiketController::delete_etiket/$1', ['filter' => 'AuthFilter']);

// Supplier
$routes->get('/daftar_supplier', 'SupplierController::daftar_supplier', ['filter' => 'AuthFilter']);
$routes->post('/tambah_supplier', 'SupplierController::tambah_supplier', ['filter' => 'AuthFilter']);
$routes->post('/edit_supplier/(:num)', 'SupplierController::edit_supplier/$1', ['filter' => 'AuthFilter']);
$routes->get('/delete_supplier/(:num)', 'SupplierController::delete_supplier/$1', ['filter' => 'AuthFilter']);

// Pabrik
$routes->get('/daftar_pabrik', 'PabrikController::daftar_pabrik', ['filter' => 'AuthFilter']);
$routes->post('/tambah_pabrik', 'PabrikController::tambah_pabrik', ['filter' => 'AuthFilter']);
$routes->post('/edit_pabrik/(:num)', 'PabrikController::edit_pabrik/$1', ['filter' => 'AuthFilter']);
$routes->get('/delete_pabrik/(:num)', 'PabrikController::delete_pabrik/$1', ['filter' => 'AuthFilter']);


$routes->post('/kasir/addToCart', 'PagesController::addToCart');
$routes->get('/kasir/viewCart', 'PagesController::viewCart');
$routes->post('/kasir/clearCart', 'PagesController::clearCart');
$routes->post('/kasir/checkout', 'PagesController::checkout');
