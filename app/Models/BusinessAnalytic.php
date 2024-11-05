<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessAnalytic extends Model
{
    use HasFactory;

    protected $table = 'business_analytics';

    protected $fillable = [
        'user_id',
        'business_id',
        'page_visits',
        'coupon_selection',
        'video_views',
        'unique_visits',
        'unique_video_visits',
        'social_media_clicks',
        'rating'
    ];
}
