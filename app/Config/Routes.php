<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Templates::index');

// route login atau sigin
$routes->get('login', 'Auth::index');
$routes->get('signup', 'Auth::signup');
$routes->post('register', 'Auth::register');
$routes->post('signin', 'Auth::signin');

// route main fiture
$routes->get('categories', 'categories::index');
$routes->get('transaction', 'transaction::index');

//route sub fiture
$routes->get('User', 'User::index');
$routes->get('User/getTotalUsers', 'User::getTotalUsers');
$routes->get('page-views', 'Analytics::getPageViews');
$routes->get('analytics/getPageViews', 'Analytics::getPageViews');
$routes->post('analytics/incrementPageView', 'Analytics::incrementPageView');






