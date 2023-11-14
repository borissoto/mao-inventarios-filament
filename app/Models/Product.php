<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'subcategory_id',
        'name',
        'description',
        'sell_price',
        'box_price',
        'wholesale_price',
        'image_url',
    ];
    
    protected $guarded = [];

    public function category(): BelongsTo{
        return $this->belongsTo(Category::class);
    }

    public function subcategory(): BelongsTo{
        return $this->belongsTo(Subcategory::class);
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function unit(): BelongsTo{
        return $this->belongsTo(Unit::class);
    }

    public function purchases(): HasMany{
        return $this->hasMany(Purchase::class);
    }
}
