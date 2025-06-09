<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/login', 'LoginController::index');
$routes->post('/login', 'LoginController::verifikasi');

$routes->get('/homecoba', 'CobaHomeController::index');

$routes->get('/home', 'Dashboard::index');