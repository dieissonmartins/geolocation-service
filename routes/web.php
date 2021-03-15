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


//test endpoint
$router->get('foo', function () {
    try{

        return response()->json([
            'data' => [
                'msg' => 'foo sucess!'
            ]
        ], 200);

    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 401);
    }
});
