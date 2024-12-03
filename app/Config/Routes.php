<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Route untuk halaman utama
$routes->get('/', 'Templates::index');

// Route untuk login dan signup
$routes->get('login', 'Auth::index');
$routes->get('signup', 'Auth::signup');
$routes->post('register', 'Auth::register');
$routes->post('signin', 'Auth::signin');
$routes->get('logout', 'Auth::logout');

// Route untuk fitur utama: Categories
$routes->group('categories', ['filter' => 'login'], function($routes) {
    $routes->get('/', 'Categories::index');   // Menampilkan daftar kategori
    $routes->get('add', 'Categories::add');   // Halaman tambah kategori
    $routes->post('add', 'Categories::add');  // Proses tambah kategori
});

// Route untuk fitur utama: Transaction
$routes->group('transaction', ['filter' => 'login'], function($routes) {
    $routes->get('/', 'Transaction::index'); // Menampilkan daftar transaksi
});

// Route untuk sub-fitur: User
$routes->group('user', ['filter' => 'login'], function($routes) {
    $routes->get('/', 'User::index');                // Menampilkan daftar user
    $routes->get('getTotalUsers', 'User::getTotalUsers'); // Mengambil total users dalam JSON
    $routes->get('add', 'User::add');               // Halaman tambah user baru
    $routes->post('add', 'User::saveuser');         // Proses tambah user dengan AJAX
    $routes->delete('delete/(:num)', 'User::delete/$1'); // Proses hapus user dengan AJAX
    $routes->get('edit/(:num)', 'User::edit/$1');   // Mendapatkan data user berdasarkan ID (untuk modal)
    $routes->post('update', 'User::update');        // Proses update user setelah diedit
});



// Route untuk sub-fitur: Analytics
$routes->group('analytics', ['filter' => 'login'], function($routes) {
    $routes->get('page-views', 'Analytics::getPageViews');  // Menampilkan jumlah page views
    $routes->get('getPageViews', 'Analytics::getPageViews'); // Alias untuk page views
    $routes->post('incrementPageView', 'Analytics::incrementPageView'); // Proses increment page view
});
