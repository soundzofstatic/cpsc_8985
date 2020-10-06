<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'user',
            'id' => $this->id,
            'attributes' => [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'username' => $this->username,
                'is_admin' => (boolean)$this->isAdmin(),
            ],
            //'relationships' => new RelationshipResource($this->resource), // todo - Fill out to be truly JSON:API compliant
//            'links' => []
        ];
    }
}
