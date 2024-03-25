<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    ];

    protected $casts = [
        'is_done' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
