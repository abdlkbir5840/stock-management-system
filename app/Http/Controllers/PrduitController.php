<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use Illuminate\Support\Facades\Validator;
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
        $produits = Produit::with('fournisseurs', 'categorie')->paginate(5);

        if (!$produits->isEmpty()) {
            return response()->json([
                'status' => 200,
                'produits' => [
                    'perPage' => $produits->perPage(),
                    'currentPage' => $produits->currentPage(),
                    'totalCount' => $produits->total(),
                    'totalPages' => $produits->lastPage(),
                    'data' => collect($produits->items())->map(function ($produit) {
                        return [
                            'id' => $produit->id,
                            'nom' => $produit->nom,
                            'image' => $produit->image,
                            'title' => $produit->title,
                            'price' => $produit->price,
                            'code_produit' => $produit->code_produit,
                            'quantite' => $produit->quantite,
                            'prix_unitaire' => $produit->prix_unitaire,
                            'description' => $produit->description,
                            'categorie_id' => $produit->categorie_id,
                            'categorie_nom' => $produit->categorie->nom,
                            'fournisseurs' => $produit->fournisseurs->map(function ($fournisseur) {
                                return [
                                    'id' => $fournisseur->id,
                                    'code_fournisseur' => $fournisseur->code_fournisseur,
                                    'nom' => $fournisseur->nom,
                                ];
                            }),
                            'created_at' => $produit->created_at,
                            'updated_at' => $produit->updated_at,
                        ];
                    }),
                ],
            ], 200);
        } else {
            return response()->json([
                'status' => "404",
                'message' => "Aucun enregistrement trouvé"
            ], 404);
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
        $validator = Validator::make($request->all(), [
            'code_produit' => 'required',
            'qte_entree' => 'required',
            'prix_unitaire' => 'required',
            'description' => 'required',
            'categorie_id' => 'required|exists:categories,id',
            'fournisseur_id' => 'required|exists:fournisseurs,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $existingProduit = Produit::where('code_produit', $request->code_produit)->first();

        if ($existingProduit) {
            //handle quantite 
            return response()->json([
                'status' => 409,
                'Message' => "Produit deja existe."
            ], 409);
        } else {
            
            $produitSaved = Produit::create([
                'code_produit' => $request->code_produit,
                'nom' => $request->nom,
                'image' => $request->image,
                'quantite' => $request->qte_entree,
                'prix_unitaire' => $request->prix_unitaire,
                'description' => $request->description,
                'categorie_id' => $request->categorie_id,
            ]);
            $produitSaved->fournisseurs()->attach($request->fournisseur_id, [
                'qte_entree' => $request->qte_entree, 
                'date_entree' => now(), 
            ]);
        
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
     * @param  string  $param
     * @param  string  $column
     * @return \Illuminate\Http\Response
     */
    public function show($column, $param)
    {
        $produits = Produit::where($column, 'LIKE', "%$param%")->with('fournisseurs','categorie')->paginate(5);

        if (!$produits) {
            return response()->json([
                'status' => 404,
                'Message' => "Produit non trouvé."
            ], 404);
        } else {
            if (!$produits->isEmpty()) {
                return response()->json([
                    'status' => 200,
                    'produits' => [
                        'perPage' => $produits->perPage(),
                        'currentPage' => $produits->currentPage(),
                        'totalCount' => $produits->total(),
                        'totalPages' => $produits->lastPage(),
                        'data' => collect($produits->items())->map(function ($produit) {
                            return [
                                'id' => $produit->id,
                                'nom' => $produit->nom,
                                'image' => $produit->image,
                                'code_produit' => $produit->code_produit,
                                'quantite' => $produit->quantite,
                                'title' => $produit->title,
                                'prix_unitaire' => $produit->prix_unitaire,
                                'price' => $produit->price,
                                'description' => $produit->description,
                                'categorie_id' => $produit->categorie_id,
                                'categorie_nom' => $produit->categorie->nom,
                                'fournisseurs' => $produit->fournisseurs->map(function ($fournisseur) {
                                    return [
                                        'id' => $fournisseur->id,
                                        'code_fournisseur' => $fournisseur->code_fournisseur,
                                        'nom' => $fournisseur->nom,
                                    ];
                                }),
                                'created_at' => $produit->created_at,
                                'updated_at' => $produit->updated_at,
                            ];
                        }),
                    ],
                ], 200);
            } 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $existingProduits = Produit::where('code_produit', 'LIKE', "%$request->code_produit%")->get();
        if ($existingProduits->isEmpty()) {
            // return response()->json([
            //     'status' => 404,
            //     'Message' => "Produit non trouvé."
            // ], 404);
            return redirect('/produits')->with('fail', "Produit non trouvé");
        } else {
            // return response()->json([
            //     'status' => 200,
            //     'data' => $existingProduit
            // ], 404);
            // $produitsArray = $existingProduits->toArray();
            return redirect('/produits')->with('produits', $existingProduits);
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
        $existingProduit = Produit::find($id);
        if (!$existingProduit) {
            // return response()->json([
            //     'status' => 404,
            //     'Message' => "Produit non trouvé."
            // ], 404);
            return redirect('/produits')->with('fail', "Produit non trouvé.");
        } else {
            $produitmatchCode = Produit::where('code_produit', $request->code)->first();
            if ($produitmatchCode) {
                return response()->json([
                    'status' => 404,
                    'Message' => "Produit avec le code $request->code déja existe ."
                ], 404);
                // return redirect('/produits')->with('fail', "Produit avec le code $request->code déja existe .");
            } else {
                $existingProduit->update($request->all());
                return response()->json([
                    'status' => 200,
                    'data' => $existingProduit
                ], 200);
                // return redirect('/produits')->with('success', "le produit s'est modifier avec succès");
            }
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
            // return redirect('/produits')->with('fail', "Produit non trouvé");
        } else {
            $existingProduit->delete();

            return response()->json([
                'status' => 200,
                'message' => "Le produit est supprimé avec succès"
            ], 200);
            // return redirect('/produits')->with('success', "Le produit est supprimé avec succès");
        }
    }
}
