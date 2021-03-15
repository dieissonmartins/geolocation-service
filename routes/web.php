<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Models\Client;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Grimzy\LaravelMysqlSpatial\Types\Polygon;
use Grimzy\LaravelMysqlSpatial\Types\LineString;

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

$router->get('/clients',                'ClientController@index');
$router->post('/clients/create/store',  'ClientController@store');
$router->post('/clients/adverts/local', 'ClientController@showAdvertsLocalization');

$router->post('/adverts/create/store',  'AnnouncementController@store');


//test endpoint
$router->get('geolocation/create', function () {
    try{

        $loc1 = new Client();
        $loc1->location = new Point(40.767864, -73.971732);
        $loc1->name     = "Supermecado BH";
        $loc1->status   = 1;
        $loc1->save();

        // Distance from loc1: 44.741406484588
        $loc2 = new Client();
        $loc2->location = new Point(40.767664, -73.971271);
        $loc2->name     = "Mart Minas";
        $loc2->status   = 1;
        $loc2->save();

        // Distance from loc1: 870.06424066202
        $loc3 = new Client();
        $loc3->location = new Point(40.761434, -73.977619);
        $loc3->name     = "Xereta supermecados";
        $loc3->status   = 1;
        $loc3->save();

        return response()->json([
            'data' => [
                'msg' => 'create sucess!'
            ]
        ], 200);

    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 401);
    }
});

$router->get('geolocation/list', function () {
    
    $latitude   = 40.767864;
    $longitude  = -73.971732;
    $rayCl      = 30; //raio em milhas

    try{
        // O método distanceSphere() é da lib instalada, 
        // você deve informar 3 parâmetros: distanceSphere($geometryColumn, $geometry, $distance); A distância deve ser informada em milhas.
        $clients = Client::distanceSphere('location', new Point($latitude, $longitude), $rayCl)
                    ->whereStatus(1) // Aqui é um exemplo de que você pode usar os métodos padrões do seu model junto com os métodos da lib
                    ->get();
        
        return response()->json([
            'data' => [
                'advertsTitle' => 'Anúncios no raio de 15 metros',
                'dataAdverts' =>  $clients
            ]
        ], 200);

    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 401);
    }
});

