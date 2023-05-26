<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Instruction extends Model
{
    use HasFactory;
    protected $fillable =
    [
        "status",
        "drone_id",
        "plan_id"
    ];
    public function drone():BelongsTo
    {
        return $this->belongsTo(Drone::class);
    }
    public function plan():BelongsTo
    {
        return $this->belongsTo(plan::class);
    }
}
