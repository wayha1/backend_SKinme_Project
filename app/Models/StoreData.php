<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreData extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        "description",
        "data_image",
        "data_video",
        "data_url",
    ];
}
