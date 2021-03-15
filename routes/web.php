<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'clients', 'middleware' => 'auth'], function() use ($router) {
    $router->get('',                'ClientController@index');
    $router->post('/create/store',  'ClientController@store');
    $router->post('/adverts/local', 'ClientController@showAdvertsLocalization');
});

$router->group(['prefix' => 'adverts', 'middleware' => 'auth'], function() use ($router) {
    $router->post('/create/store',  'AnnouncementController@store');
    $router->get('/{id}/show',     'AnnouncementController@find');
});