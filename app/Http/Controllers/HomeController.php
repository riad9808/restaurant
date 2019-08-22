<?php

namespace App\Http\Controllers;

use App\comadd;
use App\commande;
use App\produit;
use App\subcom;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');


    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

    }
    public function testt(Request $request,$id){
       // return view('view12',["id"=>$id]);
        //$p=new produit(5,"gazouz","cidre","1L","50",20);

       // return view('view12',["produit"=>$p]);

      /*  foreach ($produits as $produit){
            echo $produit->id;
        }*/
      $user = new user;
       $user->username='a';
        $salt='thisisthesaltthatisusedfortheedlprojectrestaurantappfrombbt';
        $password='salem';
        $user->password=hash('sha256',hash('sha256',$password));
        $user->type='serveur';
        $user->telephone='258';
        $user->fullname='kesh';
      //$user->save();
      $u=User::find(1);



        $commande =new commande;
        $usedid=commande::latest()->first()->id+1;
        $commande->id=$usedid;
        $commande->serveur='x';
        $commande->num_table=3;
        $commande->save();

        $souscom=new subcom;
        $souscom->num_commande=$usedid;
        $souscom->prod=1;
        $souscom->qte=2;
        $souscom->save();

        $messoucom=commande::find($usedid);

        $m=$messoucom->subcoms;
       $prix=0;
        foreach ($m as $ss){
            $prix=2;
          $unitp=produit::find($ss->prod)->prix;
          $qtco=$ss->qte;
          $prix=$unitp*$qtco;

       }
        return view('view12',["produit"=>$prix]);

}
}
