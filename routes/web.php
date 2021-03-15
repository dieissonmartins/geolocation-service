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


//test endpoint
$router->get('foo', function () {
    try{

        $place1 = new Client();
        $place1->name = 'Empire State Building';

        // saving a point with SRID 4326 (WGS84 spheroid)
        $place1->location = new Point(40.7484404, -73.9878441, 4326);	// (lat, lng, srid)
        $place1->save();

        // saving a polygon with SRID 4326 (WGS84 spheroid)
        $place1->area = new Polygon([new LineString([
            new Point(40.74894149554006, -73.98615270853043),
            new Point(40.74848633046773, -73.98648262023926),
            new Point(40.747925497790725, -73.9851602911949),
            new Point(40.74837050671544, -73.98482501506805),
            new Point(40.74894149554006, -73.98615270853043)
        ])], 4326);
        $place1->save();

        return response()->json([
            'data' => [
                'msg' => 'foo sucess!'
            ]
        ], 200);

    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 401);
    }
});
