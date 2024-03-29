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

        $point = new Point($latitude, $longitude);

        # retorna items
        $sql = Client::distanceSphere('location', $point, $ray_cl);

        # retorna items ordenado pela distancia
        # $sql = Client::orderByDistance('location', $point, 'ASC');

        $aux = $sql->get()->toArray();

        $res = $sql->toSql();

    }
}
