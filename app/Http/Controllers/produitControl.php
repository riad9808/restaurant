<?php

namespace App\Http\Controllers;

use App\produit;
use Illuminate\Http\Request;
use App\Http\Resources\produit as produitRessource;
use App\Http\Resources\produits as produitsRessource;
use mysql_xdevapi\Exception;


class produitControl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return produit::all();
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
        $produit=new Produit;
        $produit->categorie=$request->get('categorie');
        $produit->extra=$request->get('produit');
        $produit->taille=$request->get('taille');
        $produit->prix=(float)$request->get('prix');
        $produit->qtstock=(int)$request->get('qtstock');
        try{
            $produit->save();
            return json_encode(true);
        }catch (Exception $exception){
            return json_encode(false);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function show(produit $produit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function edit(produit $produit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $usedid=(int)$request->get('id');

        //

        $addedq=(int)$request->get('addedqte');
        //return json_encode(produit::find($usedid));
        $prod=produit::find($usedid);
        $qt=$prod['qtstock'];

        $newqt=$addedq+$qt;
        produit::find($usedid)->update(['qtstock'=>$newqt]);
        return json_encode('operation reussie');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function destroy(produit $produit)
    {
        //
    }
    public function delete(Request $request)
    {
        produit::destroy((int)$request->get('id'));
    }
}
