<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Map extends Model
{
    use HasFactory;
    protected $fillable =[
        "image",
        "date",
        "drone_id",
        "farm_id",
    ];

    public function drone():BelongsTo{
        return $this -> belongsTo(Drone::class);
    }
    public function farm():BelongsTo{
        return $this -> belongsTo(Farm::class);
    }
}
