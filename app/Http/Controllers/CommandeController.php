<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commandes = Commande::all();
        if($commandes->count()>0){
            $data = [
                'status'=>"200",
                'data'=>$commandes
            ];
            return view('commande.commande', ['commandes' => $commandes]);
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $commandeData = $request->all();
        
        // Set date_commande if not provided in the request
        if (!isset($commandeData['date_commande'])) {
            $commandeData['date_commande'] = now()->toDateString(); // or use the appropriate value
        }
    
        $commandeSaved = Commande::create($commandeData);
    
        if ($commandeSaved) {
            // return response()->json([
            //     'status' => 200,
            //     'commande' => $commandeSaved
            // ], 200);
            return redirect('/commandes')->with('success','Data saved');
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Internal server error'
            ], 500);
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
        $existingCommande = Commande::find($id);
        if (!$existingCommande) {
            return response()->json([
                'status' => 404,
                'Message' => "Commande non trouvé."
            ], 404);
        }else{
            return response()->json([
                'status' => 200,
                'data' => $existingCommande
            ], 200);
        }
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
        $existingCommande = Commande::find($id);
        if (!$existingCommande) {
            return response()->json([
                'status' => 404,
                'Message' => "Commande non trouvé."
            ], 404);
        }else{
            $existingCommande->update($request->all());
            return redirect('/commandes')->with('Sucess','Data updated');

            // return response()->json([
            //     'status' => 404,
            //     'data' => "La commande est modifié avec succés"
            // ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingCommande = Commande::find($id);
    
        if (!$existingCommande) {
            // return response()->json([
            //     'status' => 404,
            //     'message' => "Commande non trouvé."
            // ], 404);
                    // Rediriger avec un message de succès
        return redirect('/commandes')->with('success', 'Commande supprimé avec succès.');

        } else {
            $existingCommande->delete();
    
            // return response()->json([
            //     'status' => 200,
            //     'message' => "La commande est supprimé avec succès"
            // ], 200);
            return redirect('/commandes')->with('success', 'Commande supprimé avec succès.');
        }
    }
}
