<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
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

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/login', 'Auth::index');
$routes->post('/login/process', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
$routes->add('/sold-report', 'LaporanController::index');
$routes->add('/sold-report/print', 'LaporanController::cetak');
$routes->group('company', function ($routes) {
    $routes->get('/', 'Perusahaan::index');
    $routes->get('add', 'Perusahaan::create');
    $routes->add('save', 'Perusahaan::save');
    $routes->get('edit/(:any)', 'Perusahaan::edit/$1');
    $routes->post('update', 'Perusahaan::update/$1');
    $routes->get('delete/(:any)', 'Perusahaan::delete/$1');
});
$routes->group('profile', function ($routes) {
    $routes->get('/', 'ProfileController::index');
    $routes->add('update', 'ProfileController::updateProfile');
    $routes->get('change-password', 'ProfileController::changePass');
});
$routes->group('rekening', function ($routes) {
    $routes->get('/', 'Rekening::index');
    $routes->get('add', 'Rekening::create');
    $routes->add('save', 'Rekening::save');
    $routes->get('edit/(:any)', 'Rekening::edit/$1');
    $routes->post('update', 'Rekening::update/$1');
    $routes->get('delete/(:any)', 'Rekening::delete/$1');
});
$routes->group('client', function ($routes) {
    $routes->get('/', 'DaftarClient::index');
    $routes->get('detail', 'DaftarClient::detail');
});
$routes->group('order', function ($routes) {
    $routes->get('/', 'OrderController::index');
    $routes->get('detail', 'NotaController::index');
    $routes->post('status', 'NotaController::status');
});
$routes->group('payment', function ($routes) {
    $routes->get('/', 'PembayaranController::index');
    $routes->get('detail', 'PembayaranController::detail');
    $routes->post('status', 'NotaController::status');
});
$routes->group('portfolio', function ($routes) {
    $routes->get('/', 'PortfolioController::index');
    $routes->get('add', 'PortfolioController::add');
    $routes->add('save', 'PortfolioController::save');
    $routes->get('category', 'CategoryPortfolioController::index');
    $routes->get('category/add', 'CategoryPortfolioController::add');
    $routes->post('category/insert', 'CategoryPortfolioController::save');
    $routes->get('category/edit/(:any)', 'CategoryPortfolioController::edit/$1');
    $routes->post('category/update', 'CategoryPortfolioController::update');
    $routes->get('category/delete/(:any)', 'CategoryPortfolioController::delete/$1');
    $routes->post('status', 'NotaController::status');
});
$routes->group('paket', function ($routes) {
    $routes->get('/', 'PaketProduk::index');
    $routes->get('add', 'PaketProduk::create');
    $routes->add('save', 'PaketProduk::save');
    $routes->get('edit/(:any)', 'PaketProduk::edit/$1');
    $routes->post('update', 'PaketProduk::update/$1');
    $routes->get('delete/(:any)', 'PaketProduk::delete/$1');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
