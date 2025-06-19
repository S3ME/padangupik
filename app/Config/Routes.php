<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//  Shieldon Auth routes
service('auth')->routes($routes);

// Backoffice
$routes->group('office', ['filter' => ['chain','group:superadmin,admin']], static function ($routes) {
    service('auth')->routes($routes);
    $routes->get('/', 'Office::index');
    $routes->group('product', static function ($routes) {
        $routes->get('/', 'Products::office');
        $routes->post('new', 'Products::new');
        $routes->post('edit/(:num)', 'Products::edit/$1');
        $routes->post('delete', 'Products::delete');
        $routes->post('upload', 'Products::upload');
    });
    $routes->group('category', static function ($routes) {
        $routes->get('/', 'Products::category');
        $routes->post('new', 'Products::newcategory');
        $routes->post('edit/(:num)', 'Products::editcategory/$1');
        $routes->post('delete', 'Products::deletecategory');
    });
    $routes->group('outlet', static function ($routes) {
        $routes->get('/', 'Outlets::office');
        $routes->post('new', 'Outlets::new');
        $routes->post('edit/(:num)', 'Outlets::edit/$1');
        $routes->post('delete', 'Outlets::delete');
        $routes->post('upload', 'Outlets::upload');
    });
    $routes->group('users', ['filter' => 'group:superadmin'], static function ($routes) {
        $routes->get('/', 'Users::index');
        $routes->post('new', 'Users::new');
        $routes->post('edit/(:num)', 'Users::edit/$1');
        $routes->post('delete', 'Users::delete');
    });
    $routes->group('gallery', static function ($routes) {
        $routes->get('/', 'Gallery::index');
        $routes->post('upload', 'Gallery::upload');
        $routes->post('delete', 'Gallery::delete');
    });
    $routes->group('banner', static function ($routes) {
        $routes->get('/', 'Banners::index');
        $routes->post('upload', 'Banners::upload');
        $routes->post('delete', 'Banners::delete');
    });
});

// Frontoffice
$routes->get('/', 'Home::index');
$routes->group('product', static function ($routes) {
    $routes->get('', 'Products::index');
    $routes->get('(:any)', 'Products::detail/$1');
});
$routes->get('outlet', 'Outlets::index');
$routes->get('about', 'Home::about');
$routes->get('gallery', 'Home::gallery');
