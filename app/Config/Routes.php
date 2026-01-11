<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('dbtest', 'DevTest::dbtest');
$routes->get('/films', 'FilmController::index');
$routes->get('/films/create', 'FilmController::create');
$routes->post('/films/store', 'FilmController::store');

$routes->get('/films/edit/(:num)', 'FilmController::edit/$1');
$routes->post('/films/update/(:num)', 'FilmController::update/$1');

$routes->post('/films/delete/(:num)', 'FilmController::delete/$1');


$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::loginPost');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/admin', 'AdminController::index');
