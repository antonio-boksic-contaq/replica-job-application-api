<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobPositionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);

        return [ 
            "id"=> $this->id,
            "description"=> $this->description,

            //aggiungere relazioni con withLoaded nel momento in cu si presentano.
        ];
    }
}