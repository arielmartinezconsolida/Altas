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
$routes->add('/', 'Home::index');
$routes->add('wizard', 'Home::wizard');
$routes->add('process', 'Cron::index');
$routes->add('home/validate_date', 'Home::validate_date');
$routes->add('home/get_select_work_centers', 'Home::get_select_work_centers');
$routes->add('home/get_select_categories', 'Home::get_select_categories');
$routes->add('home/get_select_work_places', 'Home::get_select_work_places');
$routes->add('home/get_work_place_data', 'Home::get_work_place_data');
$routes->add('home/get_municipalities', 'Home::get_municipalities');
$routes->add('home/get_cnos_level_2', 'Home::get_cnos_level_2');
$routes->add('home/get_cnos_level_3', 'Home::get_cnos_level_3');

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
