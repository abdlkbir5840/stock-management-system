<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Produit;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        if($clients->count()>0){
            $data = [
                'status'=>"200",
                'data'=>$clients
            ];
            return response()->json($data, 200);
        }else{
            return response()->json([
                'status'=>"404",
                'message'=>"Aucun enregistrement trouvé"
            ],404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $existingClient = Client::where('id', $request->id)->first();

        if ($existingClient) {
            return response()->json([
                'status' => 3402,
                'Message' => "Client deja existe."
            ], 200);
        }else{
            $client = $request->all();
            $clientSaved = Client::create($client);

            if ($clientSaved) {
                return response()->json([
                    'status' => 200,
                    'produit' => $clientSaved
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Internal server error'
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
