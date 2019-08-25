<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class commande extends Model
{
    protected $table='commandes';
    //
    protected $fillable=['valide','prix'];
    public function subcoms(){
        return $this->hasMany('App\subcom','num_commande');
    }
}
