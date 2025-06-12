<?php

use CodeIgniter\Router\RouteCollection;

/**

 * @var RouteCollection $routes

 */

$routes->get('/', 'Home::index');
$routes->get('/login', 'LoginController::index');
$routes->post('/login', 'LoginController::verifikasi');
$routes->get('/homecoba', 'CobaHomeController::index');
$routes->get('/home', 'DashboardController::index');
$routes->get('/registrasi', 'RegistrasiController::index');
$routes->post('/registrasi', 'RegistrasiController::registrasi');
$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/logout', 'LoginController::logout');

$routes->post('/keranjang/tambah', 'KeranjangController::tambah');
$routes->get('/keranjang', 'KeranjangController::index');
$routes->post('/keranjang/hapus/(:num)', 'KeranjangController::hapus/$1'); 

$routes->get('/checkout', 'PembayaranController::index');
$routes->post('/checkout/proses', 'PembayaranController::prosesPembayaran');
$routes->get('/transaksi', 'PembayaranController::daftarTransaksi');
$routes->get('/transaksi/detail/(:num)', 'PembayaranController::detailTransaksi/$1');
