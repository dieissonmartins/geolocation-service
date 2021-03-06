<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    private $announcement;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Announcement $announcement)
    {
        $this->announcement = $announcement;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $data               = $request->all();
        //return $data;

		try{
			$announcement = $this->announcement->create($data);

			return response()->json([
				'data' => [
					'msg' => 'Anúncio cadastrado com sucesso!'
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
    public function find($id)
    {
        try{
            $announcement = $this->announcement->find($id);
            $announcement->qtd_view = (int)$announcement->qtd_view +1;
            $announcement->save();
    
            return response()->json([
                'data' => $announcement
            ], 200);

		} catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
		}
    }
}
