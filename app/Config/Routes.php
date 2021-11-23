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
	$routes->get('dashboard', 'Registrar::home');
	$routes->get('signout', 'Registrar::signout');

	$routes->group('auth', function($routes) {
		$routes->get('signup', 'Registrar::signup');
		$routes->post('signin', 'Registrar::auth');
		$routes->post('signup/submit', 'Registrar::request');
	});

	// payment management group
	$routes->group('payment', ['filter'=> 'auth'], function($routes) {
		$routes->get('/', 'Payment::index');
		$routes->get('(:num)', 'Payment::recordPayment/$1');
		$routes->post('searchdate', 'Payment::searchdate');
		$routes->post('searchclass', 'Payment::searchclass');
		$routes->post('search', 'Payment::search');
		$routes->post('save', 'Payment::save');
	});

	// enrollment management group
	$routes->group('enrollments', ['filter'=> 'auth'], function($routes) {
		$routes->get('/', 'Enrollment::viewEnrollments');
		$routes->post('searchdate', 'Enrollment::searchdate');
		$routes->post('searchclass', 'Enrollment::searchclass');
		$routes->post('search', 'Enrollment::search');
	});

	// ESC Voucher management group
	$routes->group('esc_request', ['filter'=> 'auth'], function($routes) {
		$routes->get('/', 'VoucherManagement::requests');
		$routes->post('verify', 'VoucherManagement::verify');
		$routes->post('approve', 'VoucherManagement::grantesc');
		$routes->post('deny', 'VoucherManagement::denyesc');
		$routes->post('searchdate/(:any)', 'VoucherManagement::searchdate/$1');
		$routes->post('searchclass/(:any)', 'VoucherManagement::searchclass/$1');
		$routes->post('search/(:any)', 'VoucherManagement::search/$1');
	});
	$routes->group('esc_approved', ['filter'=> 'auth'], function($routes) {
		$routes->get('/', 'VoucherManagement::approved');
		$routes->post('view', 'VoucherManagement::view');
		$routes->post('searchdate/(:any)', 'VoucherManagement::searchdate/$1');
		$routes->post('searchclass/(:any)', 'VoucherManagement::searchclass/$1');
		$routes->post('search/(:any)', 'VoucherManagement::search/$1');
	});
	$routes->group('esc_denied', ['filter'=> 'auth'], function($routes) {
		$routes->get('/', 'VoucherManagement::denied');
		$routes->post('view', 'VoucherManagement::view');
		$routes->post('searchdate/(:any)', 'VoucherManagement::searchdate/$1');
		$routes->post('searchclass/(:any)', 'VoucherManagement::searchclass/$1');
		$routes->post('search/(:any)', 'VoucherManagement::search/$1');
	});

	// assessment management group
	$routes->group('assessment', ['filter'=> 'auth'], function($routes) {
		$routes->get('evaluation/(:num)', 'Assessment::evaluation/$1');
		$routes->post('update', 'Assessment::updateEnrollment');
		$routes->get('(:num)', 'Assessment::viewEnrollment/$1');
		$routes->post('evaluation/save', 'Assessment::saveEvaluation');
	});

	// course managment group
	$routes->group('crs_mgt', ['filter'=> 'auth'], function($routes) {
		$routes->get('/', 'CourseManagement::index');
		$routes->get('delete_subject/(:num)/(:num)', 'CourseManagement::deleteSubject/$1/$2');
		$routes->post('update_course', 'CourseManagement::updateCourse');
		$routes->post('edit_course', 'CourseManagement::editCourse');
		$routes->post('set_course', 'CourseManagement::setCourse');
		$routes->post('new_course', 'CourseManagement::createCourse');
		$routes->post('search', 'CourseManagement::search');
	});

	// schedule managment group
	$routes->group('crs_schedule', ['filter'=> 'auth'], function($routes) {
		$routes->get('/', 'ScheduleManagement::index');
		$routes->post('new_schedule', 'ScheduleManagement::setSched');
		$routes->post('edit_schedule', 'ScheduleManagement::editSched');
		$routes->post('update_schedule', 'ScheduleManagement::updateSched');
		$routes->post('view_schedule', 'ScheduleManagement::viewSched');
		$routes->post('new_class', 'ScheduleManagement::addClass');
		$routes->post('search', 'ScheduleManagement::search');
	});
	
	// faculty management group
	$routes->group('teacher_list', ['filter'=> 'auth'], function($routes) {
		$routes->get('/', 'Teacher::index');
		$routes->get('add', 'Teacher::viewnewteacher');
		$routes->post('edit', 'Teacher::vieweditteacher');
		$routes->post('save', 'Teacher::edit');
		$routes->post('confirm_delete', 'Teacher::viewdeleteteacher');
		$routes->post('delete', 'Teacher::delete');
		$routes->post('create', 'Teacher::create');
		$routes->post('search', 'Teacher::search');
	});
});

// ADMIN ROUTE GROUP
$routes->group('a', function($routes) {
	$routes->get('/', 'Admin::index');
	$routes->get('dashboard', 'Admin::home', ['filter' => 'auth']);
	$routes->get('signout', 'Admin::signout');
	$routes->post('auth/signin', 'Admin::auth');

	$routes->group('changepass', ['filter' => 'auth'], function($routes) {
		$routes->get('/', 'Admin::changepass');
		$routes->post('save', 'Admin::savepass');
	});

	$routes->group('updateaccount', ['filter'=> 'auth'], function($routes) {
		$routes->get('/', 'Admin::update');
		$routes->post('save', 'Admin::saveuser');
	});

	$routes->group('request', ['filter'=> 'auth'], function($routes) {
		$routes->get('/', 'StudentRequest::index');
		$routes->post('approve', 'Admin::approveRequest');
		$routes->post('deny', 'Admin::denyRequest');		
		$routes->post('search', 'StudentRequest::search');	
		$routes->post('searchdate', 'StudentRequest::searchdate');	
		$routes->post('searchclass', 'StudentRequest::searchclass');	
	});
	
	$routes->group('r_request', ['filter'=> 'auth'], function($routes) {
		$routes->get('/', 'RegistrarRequest::index');
		$routes->post('approve', 'Admin::approveRequest');
		$routes->post('deny', 'Admin::denyRequest');	
		$routes->post('search', 'RegistrarRequest::search');	
		$routes->post('searchdate', 'RegistrarRequest::searchdate');		
	});
});

// STUDENT ROUTE GROUPS
$routes->group('/', function($routes) {
	$routes->get('/', 'Student::home');
	$routes->get('about', 'Student::about');
	$routes->get('auth/enrollment/(:any)', 'Enrollment::auth/$1');

	// enrollment
	$routes->group('enrollment', function($routes) {	
		$routes->get('/', 'Enrollment::index');
		$routes->group('request', function($routes){
			$routes->group('new', function($routes){
				$routes->get('/', 'Enrollment::typeNewEnrollment');
				$routes->post('submit', 'Enrollment::typeNewRequest');
			});
			$routes->group('old', function($routes){
				$routes->get('/', 'Enrollment::typeOldEnrollment');
				$routes->post('submit', 'Enrollment::typeOldRequest');
			});
		});

		$routes->post('submit', 'Enrollment::create');
		$routes->post('success', 'Enrollment::success');
	});

	// esc voucher
	$routes->group('esc', function($routes) {	
		$routes->get('/', 'VoucherManagement::index');	
		$routes->post('auth', 'VoucherManagement::auth');
		$routes->post('register', 'VoucherManagement::register');
	});	
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}