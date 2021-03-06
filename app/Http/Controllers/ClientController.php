<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UserRole;


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
        $rayCl      = 0.00932057; //raio em milhas (15 metros)

        try{
            // O método distanceSphere() é da lib instalada, 
            // você deve informar 3 parâmetros: distanceSphere($geometryColumn, $geometry, $distance); A distância deve ser informada em milhas.
            $clients = Client::distanceSphere('location', new Point($latitude, $longitude), $rayCl)
                        ->whereStatus(1) // Aqui é um exemplo de que você pode usar os métodos padrões do seu model junto com os métodos da lib
                        ->with('adverts') // Relacionamento pega anúncios da tabela (adverts)
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

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function UserStore(Request $request)
    {
        $data               = $request->all();
        
		try{
            $user = User::create([
                'name'      => $data['name'],
                'email'     => $data['email'],
                'password'  => Hash::make($data['password']),
            ]);
    
            UserRole::create([
                'role_id'   => '3',
                'model_type'=> 'App\Models\User',
                'model_id'  => $user->id,
            ]);

			return response()->json([
				'data' => [
					'msg' => 'Conta criada com sucesso!'
				]
			], 200);

		} catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
		}
    }
}
