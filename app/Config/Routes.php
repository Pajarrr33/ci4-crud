<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//ROOT OF ROUTES
$routes->get('/', 'Home::index',);

//BLOCKED ROUTES
$routes->get('/blocked','Blocked::index');

//ADMIN ROUTES
$routes->get('/admin/dashboard','Home::index',['filter' => 'authGuard']);

//USER ROUTES
$routes->get('/user/dashboard','User::index',['filter' => 'authGuard']);
$routes->get('/user/product/', 'Product::',['filter' => 'authGuard']);
//VIEW ONLY ROUTES
$routes->get('/register','Auth::register');
$routes->get('/login','Auth::login');

//ROUTES REGISTER FUNCTION ()
$routes->post('/auth/valid_register' , 'Auth::valid_register');

//ROUTES LOGIN FUNCTION
$routes->post('/auth/valid_login' , 'Auth::valid_login');

//ROUTES LOGOUT FUNCTION ()
$routes->get('/logout', 'Auth::logout');

//LOADING ROUTES FOR CRUD PRODUCT
$routes->resource('product');
