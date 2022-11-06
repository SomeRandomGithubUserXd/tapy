<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Model;

class PageTracking extends Model
{
    protected $fillable = ['page_id', 'facebook_pixel_id', 'google_analytics_tracking_id', 'yandex_metrika_id', 'tik_tok_pixel_id'];
}
