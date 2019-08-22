<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class user extends JsonResource
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
              'username' => $this->username,
              'telephone' => $this->telephone,
              'fullname' => $this->fullname,
             // 'password' => $this->password,
              'created_at' => $this->created_at,
              'updated_at' => $this->updated_at,
          ];
    }
}
