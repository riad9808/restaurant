<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class commande extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public $preserveKeys = true;

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'num_table' => $this->num_table,
            'serveur' => $this->serveur,
            'valide' => $this->valide,
            'prix' => $this->prix,


            // 'password' => $this->password,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];    }
}
