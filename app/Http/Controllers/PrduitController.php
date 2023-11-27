<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use Illuminate\Http\Request;

class PrduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produits = Produit::all();
        if($produits->count()>0){
            $data = [
                'status'=>"200",
                'data'=>$produits
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
        $existingProduit = Produit::where('code', $request->code)->first();

        if ($existingProduit) {
            return response()->json([
                'status' => 409,
                'Message' => "Produit deja existe."
            ], 409);
        }else{
            $produit = $request->all();
            $produitSaved = Produit::create($produit);
        
            if ($produitSaved) {
                return response()->json([
                    'status' => 200,
                    'produit' => $produitSaved
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
        $existingProduit = Produit::find($id);
        if (!$existingProduit) {
            return response()->json([
                'status' => 404,
                'Message' => "Produit non trouvé."
            ], 404);
        }else{
            return response()->json([
                'status' => 200,
                'data' => $existingProduit
            ], 404);
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
        $existingProduit = Produit::find($id);
        if (!$existingProduit) {
            return response()->json([
                'status' => 404,
                'Message' => "Produit non trouvé."
            ], 404);
        }else{
            $existingProduit->update($request->all());
            return response()->json([
                'status' => 404,
                'data' => "Le produit est modifié avec succés"
            ], 404);
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
        $existingProduit = Produit::find($id);
    
        if (!$existingProduit) {
            return response()->json([
                'status' => 404,
                'message' => "Produit non trouvé."
            ], 404);
        } else {
            $existingProduit->delete();
    
            return response()->json([
                'status' => 200,
                'message' => "Le produit est supprimé avec succès"
            ], 200);
        }
    }
    
}
