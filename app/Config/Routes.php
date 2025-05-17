<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', to: 'Usuario::index');
$routes->get('/login', to: 'Usuario::ingreso');
$routes->get('/registro', to: 'Usuario::registro');
$routes->post('/registrar', to: 'Usuario::create');
$routes->post('/login', to: 'Usuario::login');
$routes->get('/salir', to: 'Usuario::salir');

/**TAREAS */
$routes->get('/tareas', to: 'Tareas::index');
$routes->get('/crear', to: 'Tareas::formulario'); //MUESTRA FORMULARIO CREAR
$routes->get('/tareas/create', 'Tareas::create');
$routes->post('/tareas/create', 'Tareas::create'); 

/*SUBTAREAS*/
$routes->get('/subtareas/create', 'Subtareas::create');
$routes->post('/subtareas/create', 'Subtareas::create'); 

/*HISTORIAL*/
$routes->get('/historial', to: 'Tareas::historial');
$routes->get('detalles_historial/(:num)', 'Tareas::detalle_historial/$1');

/*COMPARTIR TAREA*/
$routes->get('tareas/formulario/(:num)', 'Tareas::formulario_compartir/$1');  // Mostrar formulario
$routes->post('tareas/compartir/(:num)', 'Tareas::compartir/$1');
$routes->post('tareas/compartirYEnviar/(:num)', 'Tareas::compartirYEnviar/$1');
$routes->post('tareas/enviar/(:num)', 'Tareas::enviar/$1');

/*COMPARTIR SUBTAREA*/
$routes->get('subtarea/formulario/(:num)', 'Subtareas::formulario_compartir/$1');
$routes->post('subtareas/compartirYEnviar/(:num)', 'Subtareas::compartirYEnviar/$1');
$routes->post('subtareas/enviar/(:num)', 'Subtareas::enviar/$1');

/*PANEL SUBTAREAS*/
$routes->get('detalles_subtarea/(:num)', 'Subtareas::detalle/$1');
$routes->get('subtareas/editar/(:num)', 'Subtareas::editar/$1');
$routes->post('subtareas/finalizar/(:num)', 'Subtareas::finalizar/$1');
$routes->get('subtareas/eliminar/(:num)', 'Subtareas::eliminar/$1');
$routes->post('subtareas/guardar', 'Subtareas::guardar');


$routes->get('detalles/(:num)', 'Tareas::detalle/$1');
$routes->get('tareas/editar/(:num)', 'Tareas::editar/$1');
$routes->get('tareas/finalizar/(:num)', 'Tareas::finalizar/$1');
$routes->get('tareas/eliminar/(:num)', 'Tareas::eliminar/$1');
$routes->post('guardar', to: 'Tareas::guardar');
$routes->get('subtareas/crear/(:num)', 'Subtareas::crear/$1');


$routes->get('colaborador', 'Tareas::colaborador');
