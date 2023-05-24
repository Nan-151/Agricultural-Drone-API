<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DroneType extends Model
{
    use HasFactory;
    protected $fillable = [
        "drone_type"
    ];

    public function drone():BelongsTo
    {
        return $this -> belongsTo(Drone::class);
    }

    public function plane():BelongsTo
    {
        return $this -> belongsTo(Plan::class);
    }

}
