<?php

namespace App\Jobs;

use App\Jobs\Interfaces\QueueJobInterface;
use Exception;
use League\Geotools\Coordinate\Coordinate;
use League\Geotools\Geotools;

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

        $ray_cl = $params['ray_cl'];

        # test distance
        $geotools = new Geotools();
        $coord_a = new Coordinate([$latitude, $longitude]);
        $coord_b = new Coordinate([-19.990224673, -44.00795550]);
        $distance = $geotools->distance()->setFrom($coord_a)->setTo($coord_b);
        $distance_in_meters = $distance->flat(); // 659166.50038742 (meters)


    }
}
