<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Drone extends Model
{
    use HasFactory;
    protected $fillable=
    [
        "name",
        "battery",
        "max_altitude",
        "max_range",
        "max_speed",
        "payload",
        "user_id",
        "drone_type_id",
    ];
    public function user():BelongsTo
    {
        return $this -> belongsTo(User::class);
    }
    public function droneType():BelongsTo
    {
        return $this -> belongsTo(DroneType::class);
    }

    public function instruction(): HasMany
    {
        return $this->hasMany(Instruction::class);
    }

    public function location():HasMany
    {
        return $this->hasMany(Location::class);
    }

    public function map():HasMany
    {
        return $this->hasMany(Map::class);
    }

   
}
