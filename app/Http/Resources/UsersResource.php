<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UsersResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => UserResource::collection($this->collection)
        ];
    }
//    public function with($request)
//    {
//        return [
//            'links'    => [
//                'self' => route('user.index'),
//            ],
//        ];
//    }
}
