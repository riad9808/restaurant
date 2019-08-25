<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    //
    protected $table='produits';
    protected $fillable=['qtstock','prix'];
    public function subcoms (){
        return $this->belongsTo('App\subcoms');
    }
}
