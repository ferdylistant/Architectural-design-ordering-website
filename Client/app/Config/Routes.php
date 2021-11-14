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
$routes->get('/portofolio', 'Portofolio\IndexController::index');
$routes->get('/contact', 'Contact\IndexController::index');
$routes->group('package', function ($routes) {
    $routes->get('/', 'Package\IndexController::index');
    $routes->get('cart', 'Package\CartController::index');
    $routes->get('cart/(:any)', 'Package\CartController::beli/$1');
    $routes->post('cart/update', 'Package\CartController::update');
    $routes->add('remove/(:segment)', 'Package\CartController::remove/$1');
    $routes->add('cancel/(:segment)', 'Package\CartController::remove_checkout/$1');
    $routes->add('destroy', 'Package\CartController::destroy');
    $routes->get('checkout', 'Checkout\IndexController::index');
    $routes->post('confirm', 'Payment\IndexController::index');
    $routes->get('payment_confirm', 'Payment\IndexController::payment');
    $routes->add('payment_action', 'Payment\IndexController::payment_action');
});
$routes->get('/notifikasi', 'Notifikasi\Notifikasi::index');
$routes->get('/about-us', 'AboutUs\IndexController::index');
$routes->get('/signin', 'Auth\IndexController::index');
$routes->post('/signin/process', 'Auth\LoginController::index');
$routes->get('/signup', 'Auth\Register\IndexController::index');
$routes->post('/signup/process', 'Auth\Register\RegisterController::index');
$routes->get('/signup/activation', 'Auth\Register\RegisterController::activation');
$routes->get('/logout', 'Auth\LogoutController::index');

$routes->group('profile', function ($routes) {
    $routes->get('/', 'Profile\IndexController::index');
    $routes->get('riwayat/detail', 'Profile\RiwayatTransaksiDetailController::index');
    $routes->add('update', 'Profile\EditController::index');
    $routes->add('change-password', 'Profile\EditController::changePassword');
});
$routes->get('/setting', 'Profile\EditController::index');
$routes->post('/api/update_status', 'Api\UpdateStatusController::index');

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
