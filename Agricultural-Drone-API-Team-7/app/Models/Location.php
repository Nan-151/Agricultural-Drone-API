<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model
{
    use HasFactory;
    protected $fillable =[
        "longitude",
        "latitude",
        "drone_id",
    ];

    public function drone():BelongsTo{
        return $this->belongsTo(Drone::class);
    }
    
}
