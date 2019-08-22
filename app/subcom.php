<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subcom extends Model
{
    protected $table ='subcoms';
    public function produit (){
        return $this->hasOne('App\Produit');
    }
}
