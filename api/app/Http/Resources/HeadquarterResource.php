<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use PHPUnit\TextUI\XmlConfiguration\Logging\TeamCity;

class HeadquarterResource extends JsonResource
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
            "country" => $this->country,
            "city"=> $this->city,
            "foreign_city" => $this->foreign_city,
            "is_main" => $this->is_main,
        ];
    }
}