<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function incomes(): HasMany{
        return $this->hasMany(Income::class);
    }

    public function country(): BelongsTo{
        return $this->belongsTo(Country::class);
    }

}
