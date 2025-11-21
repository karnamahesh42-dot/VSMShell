<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');
$routes->get('/home', 'Dashboard::index');

$routes->get('/login', 'Login::index');
$routes->get('/logout', 'Login::logout');
$routes->get('/user', 'User::index');

$routes->post('/user/create', 'User::create');

$routes->post('/login', 'Login::checkLogin');


