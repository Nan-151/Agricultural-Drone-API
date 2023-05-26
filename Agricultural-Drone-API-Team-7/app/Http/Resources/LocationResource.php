<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
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
            "id" => $this->id,
            "longitude" => $this->longitude,
            "latitude" => $this->latitude,
            "drone_name" => $this->drone->name ?? null,
        ];;
    }
}
