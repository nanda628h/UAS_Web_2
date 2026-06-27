<?php

namespace Config;

// Routes harus di-load oleh CodeIgniter. File ini merupakan konfigurasi routing
// untuk Praktikum 1 - PHP Framework (CodeIgniter 4)

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
 * Route Definitions
 */
$routes->get('/', 'Home::index');

// Route untuk halaman Page
$routes->get('/about',   'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs',    'Page::faqs');
