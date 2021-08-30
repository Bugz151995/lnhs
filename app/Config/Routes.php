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
$routes->get('r/crs_mgt', 'CourseManagement::index');
$routes->post('r/crs_mgt/delete_subject', 'CourseManagement::deleteSubject');
$routes->post('r/crs_mgt/update_course', 'CourseManagement::updateCourse');
$routes->post('r/crs_mgt/edit_course', 'CourseManagement::editCourse');
$routes->post('r/crs_mgt/set_course', 'CourseManagement::setCourse');
$routes->post('r/crs_mgt/new_course', 'CourseManagement::createCourse');

$routes->get('/', 'Registrar::index');
$routes->get('r/auth/(:segment)', 'Registrar::auth/$1');
$routes->get('a/auth/signin', 'Admin::index');

$routes->get('r/(:any)', 'Registrar::view/$1');

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