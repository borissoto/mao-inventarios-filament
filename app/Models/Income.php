<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Income extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function warehouse(): BelongsTo{
        return $this->belongsTo(Warehouse::class);
    }

    public function purchases(): HasMany{
        return $this->hasMany(Purchase::class);
    }

    public function season(): BelongsTo{
        return $this->belongsTo(Season::class);
    }

    public function supplier(): BelongsTo{
        return $this->belongsTo(Supplier::class);
    }
}
