<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CandidateResource extends JsonResource
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
            "name"=> $this->name,
            "lastname"=> $this->lastname,
            "email"=> $this->email,
            "telephone"=> $this->telephone,
            "note"=> $this->note,

            //aggiungere relazioni nel momento in cui si presentano tabelle con relazioni
        ];
    }
}