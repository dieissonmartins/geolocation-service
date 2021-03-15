<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Http\Request;


class ClientController extends Controller
{
    private $client;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        $clients = $this->client->all();

        return response()->json([
            'data' => $clients
        ], 200);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $data               = $request->all();
        $data['location']   = new Point($data['latitude'], $data['longitude']);

		try{
			$client = $this->client->create($data);

			return response()->json([
				'data' => [
					'msg' => 'Cliente cadastrado com sucesso!'
				]
			], 200);

		} catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
		}
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function showAdvertsLocalization(Request $request)
    {
        $data       = $request->all();

        $latitude   = $data['latitude'];
        $longitude  = $data['longitude'];
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
    }
}
