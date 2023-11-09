<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'subcategory_id',
        'name',
        'description',
        'price', 
        'image_url'
    ];

    public function category(): BelongsTo{
        return $this->belongsTo(Category::class);
    }

    public function subcategory(): BelongsTo{
        return $this->belongsTo(Subcategory::class);
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
