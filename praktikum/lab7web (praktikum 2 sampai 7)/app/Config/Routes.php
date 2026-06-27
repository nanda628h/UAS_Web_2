<?php

namespace Config;

$routes = Services::routes();

if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// Halaman utama
$routes->get('/', 'Home::index');

// Halaman statis (Praktikum 1)
$routes->get('/about',   'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs',    'Page::faqs');

// Artikel publik (Praktikum 2)
$routes->get('/artikel',        'Artikel::index');
$routes->get('/artikel/(:any)', 'Artikel::view/$1');

// User login/logout (Praktikum 4)
$routes->get('/user/login',  'User::login');
$routes->post('/user/login', 'User::login');
$routes->get('/user/logout', 'User::logout');

// Admin area - dilindungi filter auth (Praktikum 4)
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('artikel',                  'Artikel::admin_index');
    $routes->add('artikel/add',              'Artikel::add');
    $routes->add('artikel/edit/(:any)',      'Artikel::edit/$1');
    $routes->get('artikel/delete/(:any)',    'Artikel::delete/$1');
});
