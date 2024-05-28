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
        "brand_id"
    ];

    protected $casts = [
        'is_done' => 'boolean',
    ];

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function brands(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function userHistory(): HasMany  
    {
        return $this->hasMany(UserHistory::class);
    }
    public function userPayment(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
    public function productComments(): HasMany
    {
        return $this-> hasMany(ProductComment::class);
    }
    public function comments(): HasMany
    {
        return $this-> hasMany(Comment::class);
    }
    public function cartOrders(): HasMany
    {
        return $this->hasMany(CartOrder::class);
    }
    public function logistics(): HasMany
    {
        return $this->hasMany(Logistic::class);
    }
}
