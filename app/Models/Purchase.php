<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function income(): BelongsTo{
        return $this->belongsTo(Income::class);
    }

    public function unit(): BelongsTo{
        return $this->belongsTo(Unit::class);
    }

    public function product(): BelongsTo{
        return $this->belongsTo(Product::class);
    }
}
