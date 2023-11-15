<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Pages;
use App\Controllers\News;
use App\Controllers\Pacientes;
use App\Controllers\Clinic;

/**
 * @var RouteCollection $routes
 */

$routes->get('/',[Pacientes::class,'index']);
$routes->get('/new', [Pacientes::class, 'new']);
$routes->post('/pacientes/store', [Pacientes::class, 'create']);
$routes->post('/update', [Pacientes::class, 'update']);
$routes->get('/(:segment)', [Pacientes::class, 'delete']);
$routes->get('/edit/(:segment)', [Pacientes::class, 'show']);

$routes->group('api', static function ($routes) {
    $routes->post('xxx', [Pacientes::class, 'create']);
});

