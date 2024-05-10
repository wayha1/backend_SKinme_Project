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
        "product_name",
        "product_brand",
        "product_description",
        "product_price",
        "product_stock",
        "product_rating",
        "product_feedback",
        "product_image",
        "product_review",
        "product_banner",
        "is_done",
        "category_id",

    ];

    protected $casts = [
        'is_done' => 'boolean',
    ];

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function products(): HasMany  
    {
        return $this->hasMany(UserHistory::class);
    }
    public function userPayment(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
    public function usercomment(): HasMany
    {
        return $this-> hasMany(ProductComment::class);
    }
}
