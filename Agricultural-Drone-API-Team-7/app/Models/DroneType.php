<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DroneType extends Model
{
    use HasFactory;
    protected $fillable = [
        "drone_type"
    ];

    public function drone():HasMany
    {
        return $this -> hasMany(Drone::class);
    }

    public function plane():HasMany
    {
        return $this -> hasMany(Plan::class);
    }

}
