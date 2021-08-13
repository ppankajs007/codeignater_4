<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Admin');
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
$routes->get('/', 'Admin::index');
$routes->get('/register', 'Admin::register');
$routes->post('/registeruser', 'Admin::registerUser');
$routes->post('/checkusername', 'Admin::checkusernamer');
$routes->post('/admin/emailVerfy/(:any)', 'Admin::emailVerfy/$1');
$routes->get('/admin/generateOtp', 'Admin::generateOtp');

$routes->match(['get','post'],'/admin/forgetpassword', 'Admin::forgetpassword');
$routes->match(['get','post'],'/admin/resetpassword/(:any)', 'Admin::resetpassword/$1');
$routes->match(['get','post'],'/admin/resetByPhone/(:any)', 'Admin::resetByPhone/$1');
$routes->post('/admin/forgetByOtp', 'Admin::forgetByOtp');
$routes->post('/admin/resetPasswordByotp', 'Admin::resetPasswordByotp');
$routes->post('/admin/existPhone', 'Admin::existPhone');
$routes->get('/admin/checkEmailExist', 'Admin::checkEmailExist');


/* permission modules */

$routes->match(['get','post'],'/permission', 'Permission::index', ['filter' => 'isLogin']);
$routes->post('/permission/add-permission-module', 'Permission::add_permission_module', ['filter' => 'isLogin']);



/* users */

$routes->get('/users', 'Users::index', ['filter' => 'isLogin']);
$routes->match(['get','post'],'/users/edit/(:any)', 'Users::edit/$1', ['filter' => 'isLogin']);
$routes->match(['get','post'],'/users/change-password', 'Users::changePassword', ['filter' => 'isLogin']);
$routes->match(['get','post'],'/users/add', 'Users::add', ['filter' => 'isLogin']);
$routes->match(['get','post'],'/users/delete/(:any)', 'Users::delete/$1', ['filter' => 'isLogin']);


/* dashboard */



$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'isLogin']);

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
