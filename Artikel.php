<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// =========================================================
// Route Default
// =========================================================
$routes->get('/', 'Home::index');

// =========================================================
// Praktikum 8: AJAX Routes
// =========================================================
$routes->get('ajax', 'AjaxController::index');
$routes->get('ajax/getData', 'AjaxController::getData');
$routes->delete('ajax/delete/(:num)', 'AjaxController::delete/$1');

// =========================================================
// Praktikum 9: Admin Artikel (AJAX Pagination & Search)
// =========================================================
$routes->get('admin/artikel', 'Artikel::admin_index');
$routes->get('admin/artikel/edit/(:num)', 'Artikel::edit/$1');
$routes->delete('admin/artikel/delete/(:num)', 'Artikel::delete/$1');

// =========================================================
// Praktikum 10: REST API — resource route (GET semua endpoint sekaligus)
// $routes->resource('post'); // ← Uncomment ini untuk cara singkat
//
// Praktikum 14: Endpoint GET boleh bebas, tapi POST/PUT/DELETE dilindungi filter
// =========================================================

// GET endpoints — bebas tanpa token
$routes->get('post', 'Api\Post::index');
$routes->get('post/(:segment)', 'Api\Post::show/$1');
$routes->get('post/new', 'Api\Post::new');
$routes->get('post/(:segment)/edit', 'Api\Post::edit/$1');

// Manipulasi data — WAJIB membawa token (Praktikum 14)
$routes->post('post', 'Api\Post::create', ['filter' => 'apiauth']);
$routes->put('post/(:segment)', 'Api\Post::update/$1', ['filter' => 'apiauth']);
$routes->delete('post/(:segment)', 'Api\Post::delete/$1', ['filter' => 'apiauth']);
$routes->patch('post/(:segment)', 'Api\Post::update/$1', ['filter' => 'apiauth']);

// =========================================================
// Praktikum 13-14: Auth endpoint
// =========================================================
$routes->post('auth/login', 'Api\Auth::login');
