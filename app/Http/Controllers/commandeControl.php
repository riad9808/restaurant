<?php

namespace App\Http\Controllers;
use App\commande;
use App\Http\Resources\produit;
use App\subcom;
use Illuminate\Http\Request;

class commandeControl extends Controller
{
    public function comavaservir (Request $request){
        $par=$request->get('serveur');
        $coms=commande::where('serveur',$par)->whereIn('valide',['valide','prete','annuler','nonvalide'])->get();
        $comcomplette=[];
        $i=0;
        foreach ($coms as $com){
            $comcomplette[$i]=$com;
            $comcomplette[$i]["souscom"]=commande::find($com["id"])->subcoms()->get();

            $subcomsprod=commande::find($com["id"])->subcoms()->get();
            $j=0;
            foreach($subcomsprod as $s){

                $comcomplette[$i]["souscom"][$j]["produit"]=$s->produit()->get();
                $j++;
            }
            //$comcomplette[$i]["commande"]["souscom"]["produit"]=commande::find($com["id"])->subcoms()->get();
            $i++;
        }

        return json_encode($comcomplette);
       //return json_encode(commande::where('valide','valide')->get());
    }
    public function comavalider (Request $request){
        $coms=commande::whereIn('valide',['nonvalide','valide'])->get();
        $comcomplette=[];
        $i=0;
        foreach ($coms as $com){
            $comcomplette[$i]=$com;
            $comcomplette[$i]["souscom"]=commande::find($com["id"])->subcoms()->get();

            $subcomsprod=commande::find($com["id"])->subcoms()->get();
            $j=0;
            foreach($subcomsprod as $s){

                $comcomplette[$i]["souscom"][$j]["produit"]=$s->produit()->get();
                $j++;
            }
            //$comcomplette[$i]["commande"]["souscom"]["produit"]=commande::find($com["id"])->subcoms()->get();
            $i++;
        }

        return json_encode($comcomplette);
       //return json_encode(commande::where('valide','valide')->get());
    }
    public function validateur(Request $request)
    {

        $id=$request->get('id');
        //return json_encode($id);
        $c=commande::find($id)->update(['valide'=>'valide']);
        $subcommands=commande::find($id)->subcoms()->get();

        foreach ($subcommands as $s1){


            $idprod=$s1['prod'];

            $quantitecom=$s1['qte'];


            $col= \App\Produit::find($idprod);

            $quantp=$col['qtstock'];

            \App\Produit::find($idprod)->update(['qtstock'=>$quantp-$quantitecom]);


        }

        $prix=0;
        foreach($subcommands as $s1){

            $idprod=$s1['prod'];
            $quantitecom=$s1['qte'];
            $prixsouscom=0;
            $col= \App\Produit::find($idprod);
            $prixunit=$col['prix'];
            //return json_encode(commande::find($id));

            $prixsouscom=$prixunit*$quantitecom;
            $prix=$prix+$prixsouscom;
        }
        commande::find($id)->update(['prix'=>$prix]);
        return json_encode(true);


    }
    public function store(Request $request)
    {

            $commande =new commande;
            $before=commande::latest()->first()->id;
            $usedid=$before+1;
            $commande->id=$usedid;
            $commande->serveur=$request->get('serveur');
            $commande->num_table=$request->get('numtable');
           //$s= json_decode($request->get('souscom'));
            //return json_encode($request->get('souscom')[0]["qte"]);

            $subcomms=[];
            $souscoms=$request->get('souscom');
            $i=0;
            foreach ($souscoms as $s1){

                $subcom=new subcom;
                $subcom->prod=$s1["prod"];
                $subcom->qte=$s1["qte"];
                $subcom->num_commande=$usedid;
                $quantp= \App\Produit::find($s1["prod"])->pluck('qtstock')[0];
               // \App\Produit::find($s1["prod"])->update(['qtstock'=>$quantp-$s1["qte"]]);
                $subcomms[$i]=$subcom;
                $i++;

            }
            //return json_encode($subcomms);
            $commande->save();
            $commander = commande::find($usedid);
            foreach ($subcomms as $sub){
                $commander->subcoms()->save($sub);
            }
           // $commande->subcoms()->save($subcomms);
            return json_encode('succes');




    }
    public function annuler(Request $request){
        $id=$request->get('id');
        //return json_encode($id);
        $c=commande::find($id)->update(['valide'=>'annuler']);
    }
    public function prete(Request $request){
        $id=$request->get('id');
        //return json_encode($id);
        $c=commande::find($id)->update(['valide'=>'prete']);
    }
    public function payer(Request $request){
        $id=$request->get('id');
        //return json_encode($id);
        $c=commande::find($id)->update(['valide'=>'paye']);
    }
    public function apayer(Request $request){
        $coms=commande::where('valide','prete')->get();
        $comcomplette=[];
        $i=0;
        foreach ($coms as $com){
            $comcomplette[$i]=$com;
            $comcomplette[$i]["souscom"]=commande::find($com["id"])->subcoms()->get();

            $subcomsprod=commande::find($com["id"])->subcoms()->get();
            $j=0;
            foreach($subcomsprod as $s){

                $comcomplette[$i]["souscom"][$j]["produit"]=$s->produit()->get();
                $j++;
            }
            //$comcomplette[$i]["commande"]["souscom"]["produit"]=commande::find($com["id"])->subcoms()->get();
            $i++;
        }

        return json_encode($comcomplette);
    }
    public function retirercom(Request $request){
        commande::destroy((int)$request->get('id'));
        return json_encode(true);
    }
    public function lastchanges(Request $request){
       // $latestcreated=commande::latest()->first();
       // $lastdatecreated=$latestcreated['created_at'];
        $latestupdated=commande::latest('updated_at')->first();
        $lastupdatedate=$latestupdated['updated_at'];
        return json_encode($lastupdatedate);
        /*if($lastdatecreated>=$lastupdatedate){
            return json_encode($lastdatecreated);
        }
        else{
            return json_encode($lastupdatedate);
        }*/
    }
}




