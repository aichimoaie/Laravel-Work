<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class USERResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'active' => $this->active,
            'email_verified_at' => $this->email_verified_at,
            'deleted_at' =>$this->deleted_at,
            'roles' =>  $this->getRoleNames()->implode('roles', ', ')
        ];
    }
}
