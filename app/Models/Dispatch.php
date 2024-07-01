<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dispatch extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function purchase(): BelongsTo{
        return $this->belongsTo(Purchase::class);
    }

    public function product(): BelongsTo{
        return $this->belongsTo(Product::class);
    }
    
    //borrar? no sirve el groupinggroup en dispatch
    public function income(): BelongsTo{
        return $this->belongsTo(Income::class);
    }    
}
