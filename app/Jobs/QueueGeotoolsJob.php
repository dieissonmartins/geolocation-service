<?php

namespace App\Jobs;

use App\Jobs\Interfaces\QueueJobInterface;
use Exception;
use League\Geotools\Coordinate\Coordinate;
use League\Geotools\Geotools;
use League\Geotools\Polygon\Polygon;

class QueueGeotoolsJob implements QueueJobInterface
{

    /**
     * @return int[]
     */
    public function _Debug(): array
    {
        $params = [
            'latitude' => -19.99092218,
            'longitude' => -44.00930471,
            'ray_cl' => 1000 // metros
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
        $latitude = $params['latitude'];
        $longitude = $params['longitude'];

        $latitude_b = -19.990224673;
        $longitude_b = -44.00795550;

        $ray_cl = $params['ray_cl'];

        # test distance
        $geotools = new Geotools();
        $coord_a = new Coordinate([$latitude, $longitude]);
        $coord_b = new Coordinate([$latitude_b, $longitude_b]);

        $distance = $geotools->distance()->setFrom($coord_a)->setTo($coord_b);

        $distance_in_meters = $distance->flat(); // 160.91117492784232 (meters)

        $circle = $distance->greatCircle();

    }
}
