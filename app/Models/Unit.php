<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unit extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products(): HasMany{
        return $this->hasMany(Product::class);
    }

    public function purchases(): HasMany{
        return $this->hasMany(Purchase::class);
    }
}
