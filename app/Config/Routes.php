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

// REGISTRAR ROUTE GROUP
$routes->group('r', function($routes) {
	$routes->get('/', 'Registrar::index');
	// enrollment management group
	$routes->get('enrollments', 'Enrollment::viewEnrollments');

	// assessment management group
	$routes->get('assessment/(:num)', 'Assessment::viewEnrollment/$1');

	// course managment group
	$routes->group('crs_mgt', function($routes) {
		$routes->get('/', 'CourseManagement::index');
		$routes->get('delete_subject/(:num)/(:num)', 'CourseManagement::deleteSubject/$1/$2');
		$routes->post('update_course', 'CourseManagement::updateCourse');
		$routes->post('edit_course', 'CourseManagement::editCourse');
		$routes->post('set_course', 'CourseManagement::setCourse');
		$routes->post('new_course', 'CourseManagement::createCourse');
	});

	// schedule managment group
	$routes->group('crs_schedule', function($routes) {
		$routes->get('/', 'ScheduleManagement::index');
		$routes->post('new_schedule', 'ScheduleManagement::setSched');
		$routes->post('edit_schedule', 'ScheduleManagement::editSched');
		$routes->post('update_schedule', 'ScheduleManagement::updateSched');
		$routes->post('view_schedule', 'ScheduleManagement::viewSched');
		$routes->post('new_section', 'ScheduleManagement::addSection');
	});
	
	$routes->get('(:any)', 'Registrar::view/$1');
});

// STUDENT ROUTE GROUPS
$routes->group('/', function($routes) {
	$routes->get('/', 'Student::home');
	$routes->get('about', 'Student::about');

	// enrollment
	$routes->group('enrollment', function($routes) {	
		$routes->get('/', 'Enrollment::index');
		$routes->post('submit', 'Enrollment::create');
		$routes->post('success', 'Enrollment::success');
	});

	// esc voucher
	$routes->group('esc_registration', function($routes) {	
		$routes->get('/', 'VoucherManagement::index');
	});
});

$routes->get('r/auth/(:segment)', 'Registrar::auth/$1');
$routes->get('a/auth/signin', 'Admin::index');

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