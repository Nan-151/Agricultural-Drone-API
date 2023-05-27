<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Plan extends Model
{
    use HasFactory;
    protected $fillable =
    [
        "name",
        "date",
        "time",
        "area",
        "plan_type_id",
        "farm_id",
        "user_id",
    ];

    public function instruction(): HasMany
    {
        return $this->hasMany(Instruction::class);
    }

    public function planType():BelongsTo
    {
        return $this->belongsTo(DroneType::class);
    }

    public function farm():BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
