<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'comment_id',
        'product_id'
    ];
    
    public function comments(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }
    public function products(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }
}
