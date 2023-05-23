<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Farm extends Model
{
    use HasFactory;
    protected $fillable =[
        "farm_name",
        "province_id"
    ];
    public function province():BelongsTo{
        return $this->belongsTo(Province::class);
    }

    public function map():HasMany{
        return $this->hasMany(Map::class);
    }
}
