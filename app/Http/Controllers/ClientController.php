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
//        $clients = Client::all();
//        if($clients->count()>0){
//            $data = [
//                'status'=>"200",
//                'data'=>$clients
//            ];
//            return response()->json($data, 200);
//        }else{
//            return response()->json([
//                'status'=>"404",
//                'message'=>"Aucun enregistrement trouvé"
//            ],404);
//        }
        // Récupérer tous les clients depuis la base de données
        $clients = Client::all();

        // Passer les clients à la vue pour l'affichage
        return view('clients.index', ['clients' => $clients]);
//        return redirect('Client.index')->with('success',"Data saved");
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
        $existingClient = Client::where('email', $request->email)->first();

        if ($existingClient) {
            return redirect('/clients')->with('fail',"Client deja existe");
        }else{
            $client = $request->all();
            $clientSaved = Client::create($client);
                return redirect('/clients')->with('success',"le client s'est ajout avec succès");

//                return response()->json([
//                    'status' => 500,
//                    'message' => 'Internal server error'
//                ], 500);

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
//        $existingClient= Client::find($id);
//        if (!$existingClient) {
//            return response()->json([
//                'status' => 404,
//                'Message' => "Client non trouvé."
//            ], 404);
//        }else{
//            return response()->json([
//                'status' => 200,
//                'data' => $existingClient
//            ], 404);
//        }
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
//        $existingClient = Client::find($id);
//        if (!$existingClient) {
//            return response()->json([
//                'status' => 404,
//                'Message' => "Client non trouvé."
//            ], 404);
//        }else{
//            $existingClient->update($request->all());
//            return response()->json([
//                'status' => 404,
//                'data' => "Le client est modifié avec succés"
//            ], 404);
//        }
        $client = Client::findOrFail($id);

        $client->update($request->all());

        return redirect('/clients')->with('success', 'Client mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Récupérer le client à supprimer
        $client = Client::findOrFail($id);

        // Supprimer le client
        $client->delete();

        // Rediriger avec un message de succès
        return redirect('/clients')->with('success', 'Client supprimé avec succès.');
    }
}
