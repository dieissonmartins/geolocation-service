<?php

namespace App\Jobs;

use App\Jobs\Interfaces\QueueJobInterface;
use App\Models\Client;
use Exception;
use Grimzy\LaravelMysqlSpatial\Types\Point;

class QueueCreateGeoJob implements QueueJobInterface
{

    /**
     * @return int[]
     */
    public function _Debug(): array
    {
        $params = [
            [
                'name' => 'SUPERMERCADOS BH NA PRAÇA BARREIRO',
                'location' => new Point(-19.99473440,-44.00667916),
                'status' => 1
            ],
            [
                'name' => 'SUPERMERCADOS BH RUA PRINCIPAL',
                'location' => new Point(-19.98998558,-44.01358240),
                'status' => 1
            ],
            [
                'name' => 'SUPERMERCADOS BH OUTRO',
                'location' => new Point(-19.99265381,-44.05562504),
                'status' => 1
            ],
            [
                'name' => 'FINAL DA MINHA RUA',
                'location' => new Point(-19.99041218,-44.00831479),
                'status' => 1
            ]
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
        $entities = $params;

        foreach ($entities as $row) {

            Client::create($row);

        }

    }
}
