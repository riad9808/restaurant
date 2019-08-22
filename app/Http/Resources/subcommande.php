<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class subcommande extends JsonResource
{
    public $preserveKeys = true;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'num_commande' => $this->num_commande,
            'prod' => $this->prod,
            'qte' => $this->qte,
            // 'password' => $this->password,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
