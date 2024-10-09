<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//Auth
$routes->get('/login', 'AuthController::index');
$routes->post('/proses_login', 'AuthController::proses_login');
$routes->get('/register', 'AuthController::register');
$routes->post('/proses_register', 'AuthController::proses_register');
$routes->get('/logout', 'AuthController::logout');

//pages
$routes->get('/home', 'PagesController::home', ['filter' => 'AuthFilter']);
$routes->get('/kasir', 'PagesController::kasir', ['filter' => 'AuthFilter']);

//obat
$routes->get('/daftar_obat', 'ObatController::daftar_obat', ['filter' => 'AuthFilter']);
$routes->post('/tambah_obat', 'ObatController::tambah_obat', ['filter' => 'AuthFilter']);
$routes->post('/edit_obat/(:num)', 'ObatController::edit_obat/$1', ['filter' => 'AuthFilter']);
$routes->get('/delete_obat/(:num)', 'ObatController::delete_obat/$1', ['filter' => 'AuthFilter']);

//Kategori
// $routes->get('/daftar_kategori', 'ObatController::daftar_kategori', ['filter' => 'AuthFilter']);
$routes->post('/tambah_kategori', 'ObatController::tambah_kategori', ['filter' => 'AuthFilter']);
$routes->get('/daftar_kategori', 'ObatController::daftar_kategori');
