<?php

namespace App\Models\Page;

use App\Models\Page\Pivot\PageTheme;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Page extends Model
{
    protected $fillable = ['uuid', 'user_id', 'name', 'link'];

    protected $with = ['theme', 'pageTracking', 'pageSeo', 'pageElements'];

    protected $appends = ['qr_code'];

    public function getQrCodeAttribute(): string
    {
        return \QrCode::generate(config('app.url').'/'.$this->link)->toHtml();
    }

    public function pageTracking(): HasOne
    {
        return $this->hasOne(PageTracking::class, 'page_id');
    }

    public function pageSeo(): HasOne
    {
        return $this->hasOne(PageSeo::class, 'page_id');
    }

    public function pageElements(): HasMany
    {
        return $this->hasMany(PageElement::class, 'page_id')->orderBy('order_column');
    }

    public function theme(): BelongsToMany
    {
        return $this
            ->belongsToMany(Theme::class)
            ->using(PageTheme::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'page_id');
    }
}
