<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DroneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "name"=>$this->name,
            "battery" => $this->battery,
            "max_altitude"=>$this->max_altitude,
            "max_range" => $this->max_range,
            "max_speed" => $this->max_speed,
            "payload" => $this->payload,
            "drone_type_id" => $this->drone_type_id,
        ];
    }
}
