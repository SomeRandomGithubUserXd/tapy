<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PageSeo extends Model implements HasMedia
{
    use InteractsWithMedia;

    public static string $faviconCollection = 'FAVICON_MEDIA_COLLECTION';

    protected $fillable = ['page_id', 'title', 'description'];

    protected $appends = ['favicon'];

    public function getFaviconAttribute(): string|null
    {
        if ($this->hasMedia(self::$faviconCollection)) {
            return $this->getMedia(self::$faviconCollection)->first()->getUrl();
        }
        return null;
    }
}
