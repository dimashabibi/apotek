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
