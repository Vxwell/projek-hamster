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