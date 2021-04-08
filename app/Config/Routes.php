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
$routes->get('/indexold', 'Home::indexold');
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/login', 'User::login');
$routes->get('/logout', 'User::logout',['filter' => 'LoginFilter']);
$routes->get('/register', 'User::register');
$routes->get('/registeradmin', 'User::registeradmin');
$routes->get('/profil', 'User::profil', ['filter' => 'LoginFilter']);
$routes->get('/profil/edit/','User::edit',['filter' => 'LoginFilter']);
$routes->get('/profil/gantipassword/','User::gantipassword',['filter' => 'LoginFilter']);
$routes->get('/proyek','Proyek::index',['filter' => 'LoginFilter']);
$routes->get('/proyek/join','Proyek::join',['filter' => 'LoginFilter']);
$routes->get('/proyek/create','Proyek::create',['filter' => 'LoginFilter']);
$routes->get('/proyek/(:segment)','Proyek::detail/$1',['filter' => 'LoginFilter']);
$routes->get('/proyek/(:segment)/meeting','Proyek::meeting/$1',['filter' => 'LoginFilter']);
$routes->get('/proyek/(:segment)/board','Proyek::board/$1',['filter' => 'LoginFilter']);
$routes->get('/proyek/(:segment)/board2','Proyek::board2/$1',['filter' => 'LoginFilter']);
$routes->get('/proyek/(:segment)/resource','Proyek::resource/$1',['filter' => 'LoginFilter']);
$routes->get('/proyek/(:segment)/presensi','Proyek::presensi/$1',['filter' => 'LoginFilter']);
$routes->get('/proyek/meetingjoin/(:segment)','Proyek::meetingjoin/$1',['filter' => 'LoginFilter']);
$routes->get('/proyek/deletemember/(:segment)/(:segment)','Proyek::deletemember/$1/$2',['filter' => 'LoginFilter']);
$routes->get('/dashboard','Admin::dashboard',['filter' => 'AdminFilter']);
$routes->get('/dashboard/proyek','Admin::project',['filter' => 'AdminFilter']);
$routes->get('/dashboard/proyek/(:segment)','Admin::detailProject/$1',['filter' => 'AdminFilter']);
$routes->get('/dashboard/member','Admin::member',['filter' => 'AdminFilter']);
$routes->get('/dashboard/proyek/(:segment)/member','Admin::projectMember/$1',['filter' => 'AdminFilter']);
$routes->get('/dashboard/meeting','Admin::meeting',['filter' => 'AdminFilter']);
$routes->get('/dashboard/proyek/(:segment)/meeting','Admin::projectMeeting/$1',['filter' => 'AdminFilter']);
$routes->get('/dashboard/proyek/(:segment)/sprint','Admin::projectSprint/$1',['filter' => 'AdminFilter']);
$routes->get('/dashboard/user','Admin::user',['filter' => 'AdminFilter']);
$routes->get('/dashboard/user/(:segment)','Admin::user/$1',['filter' => 'AdminFilter']);
$routes->get('/user/registerAdmin','User::registerAdmin',['filter' => 'AdminFilter']);
// $routes->get('/dashboard/member/(:segment)/(:segment)','Admin::member/$1/$2',['filter' => 'AdminFilter']);

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
