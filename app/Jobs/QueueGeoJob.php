<?php

namespace App\Jobs;

use App\Jobs\Interfaces\QueueJobInterface;
use App\Models\Client;
use Exception;
use Grimzy\LaravelMysqlSpatial\Types\Point;

class QueueGeoJob implements QueueJobInterface
{

    /**
     * @return int[]
     */
    public function _Debug(): array
    {
        $params = [
            'latitude' => -19.99092218,
            'longitude' => -44.00930471,
            'ray_cl' => 0.00932057  //raio em milhas (15 metros)
        ];

        return $params;
    }

    /**
     * @throws Exception
     */
    public function _Validate(array $params): bool
    {
        return true;
    }

    /**
     * @param array $params
     * @return void
     */
    public function _Execute(array $params): void
    {
        $debug = $params;

        $latitude = $params['latitude'];
        $longitude = $params['longitude'];
        $ray_cl = $params['ray_cl'];

        $point = new Point($latitude, $longitude);

        $clients = Client::distanceSphere('location', $point, $ray_cl);

        $res = $clients->get();

        $aux = $res->toArray();


    }
}
