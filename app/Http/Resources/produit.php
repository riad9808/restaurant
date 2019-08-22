<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class produit extends JsonResource
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
            'categorie' => $this->categorie,
            'extra' => $this->extra,
            'taille' => $this->taille,
            'prix' => $this->prix,
            'qtstock' => $this->qtstock,


            // 'password' => $this->password,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
