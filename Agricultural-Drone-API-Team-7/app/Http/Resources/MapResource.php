<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MapResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return 
        [
            "drone_name" => $this->drone->name ?? null,
            "image" => $this->image,
            "date" => $this->date,
            "farm" => new FarmResource($this->farm) ,
          
        ];
    }
}
