<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index',['as'=>'home']);
$routes->group('user', ['filter' => 'user'], static function ($routes) {
    $routes->get('dashboard', 'User::index',['as'=>'userDashboard']);
    $routes->get('hazard', 'User::hazard',['as'=>'userHazard']);
    $routes->get('hazard/add', 'User::addHazard',['as'=>'userAddHazard']);
    $routes->post('hazard/store', 'User::storeHazard',['as'=>'userStoreHazard']);
    $routes->get('hazard/edit/(:any)', 'User::editHazard/$1',['as'=>'userEditHazard']);
    $routes->post('hazard/update/(:any)', 'User::updateHazard/$1',['as'=>'userUpdateHazard']);
    $routes->get('hazard/delete/(:any)', 'User::deleteHazard/$1',['as'=>'userDeleteHazard']);


});
$routes->group('admin', ['filter' => 'admin'], static function ($routes) {
    $routes->get('dashboard', 'Admin::index',['as'=>'adminDashboard']);
    $routes->get('user', 'Admin::user',['as'=>'adminUser']);
    $routes->get('user/add', 'Admin::addUser',['as'=>'adminAddUser']);
    $routes->post('user/store', 'Admin::storeUser',['as'=>'adminStoreUser']);
    $routes->get('user/edit/(:any)', 'Admin::editUser/$1',['as'=>'adminEditUser']);
    $routes->post('user/update/(:any)', 'Admin::updateUser/$1',['as'=>'adminUpdateUser']);
    $routes->get('user/delete/(:any)', 'Admin::deleteUser/$1',['as'=>'adminDeleteUser']);

    $routes->get('hazard', 'Admin::hazard',['as'=>'adminHazard']);
    $routes->get('hazard/add', 'Admin::addHazard',['as'=>'adminAddHazard']);
    $routes->post('hazard/store', 'Admin::storeHazard',['as'=>'adminStoreHazard']);
    $routes->get('hazard/edit/(:any)', 'Admin::editHazard/$1',['as'=>'adminEditHazard']);
    $routes->post('hazard/update/(:any)', 'Admin::updateHazard/$1',['as'=>'adminUpdateHazard']);
    $routes->get('hazard/delete/(:any)', 'Admin::deleteHazard/$1',['as'=>'adminDeleteHazard']);

    $routes->post('hazard/report', 'Admin::exportHazardExcel',['as'=>'exportHazardExcel']);

});

// register
$routes->get('/register', 'Register::index',['as'=>'register']);
$routes->post('/register/process', 'Register::process');
//login
$routes->get('/login', 'Login::index',['as'=>'login']);
$routes->post('/login/process', 'Login::process',['as'=>'loginProcess']);
//logout
$routes->post('/logout', 'Login::logout');
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
