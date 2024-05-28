<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Logistic extends Model
{
    use HasFactory;
    protected $fillable = [
        'logistic_name',
        'deliver_name',
        'date_delivery',
        'product_id'
    ];
    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
