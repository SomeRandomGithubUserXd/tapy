<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PageElement extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['page_id', 'component_alias', 'props', 'order_column'];

    public static string $profilePicCollection = "PROFILE_PIC_COLLECTION";

    protected $casts = [
        'props' => 'json'
    ];

    public function updateProps(array $props): bool
    {
        return $this->update(['props' => $props]);
    }
}
