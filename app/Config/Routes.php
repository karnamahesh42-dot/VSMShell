<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');
$routes->get('/home', 'Dashboard::index');

$routes->get('/login', 'Login::index');
$routes->get('/logout', 'Login::logout');
$routes->post('/login', 'Login::checkLogin');

$routes->get('/user', 'User::index');
$routes->post('/user/create', 'User::create');
$routes->get('/userlist', 'User::userListData');

$routes->get('/visitorequest', 'VisitorRequest::index'); // add User Form
$routes->get('/visitorlistdata', 'VisitorRequest::visitorData'); //to get The visiter Reuest List Data 
$routes->get('/visitorequestlist', 'VisitorRequest::visitorDataListView'); // //to get The visiter Reuest View
$routes->post('/visitorequest/create','VisitorRequest::submit');
$routes->post('/approvalprocess', 'VisitorRequest::approvalProcess');//To Approval Process 
$routes->get('/getvisitorrequestdata/(:num)', 'VisitorRequest::getVisitorRequastDataById/$1'); //To get Visito Request Data By ID





// $routes->get('/', 'VisitorController::create');
// $routes->get('/visitor/create','VisitorController::create');
// $routes->post('/visitor/submit','VisitorController::submit');
// $routes->get('/visitor/success','VisitorController::success');

// $routes->get('/admin/pending','AdminController::pending');
// $routes->post('/admin/approve','AdminController::approve');

// $routes->get('/security/scanner','SecurityController::scannerView');
// $routes->post('/security/verify','SecurityController::verify');