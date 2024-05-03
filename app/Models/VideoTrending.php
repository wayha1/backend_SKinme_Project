<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VideoTrending extends Model
{
    use HasFactory;
    protected $fillable = [
        "category_id",
        "video_title1",
        "video1",
        "video_title2",
        "video2",
        "video_title3",
        "video3",
        "video_title4",
        "video4",
        "video_title5",
        "video5",
    ];

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
