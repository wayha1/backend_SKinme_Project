<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        "category_title",
        "category_icon",
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    public function videosTending(): HasMany
    {
        return $this->hasMany(VideoTrending::class);
    }
}
