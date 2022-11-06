<?php

namespace App\Models\Page;

use App\Models\Page\Pivot\PageTheme;
use App\Models\Theme;
use App\Models\User;
use Carbon\Carbon;
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
        return \QrCode::generate(config('app.url') . '/' . $this->link)->toHtml();
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

    public function linkClicks(): HasMany
    {
        return $this->hasMany(LinkClick::class, 'page_id');
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class, 'page_id');
    }

    public function getLinkClicksGroupedAttribute(): array
    {
        $clicks = $this->linkClicks;
        $clicksGrouped = [];
        foreach ($clicks as $click) {
            if (isset($clicksGrouped[$click['link_name']])) {
                ++$clicksGrouped[$click['link_name']];
            } else {
                $clicksGrouped[$click['link_name']] = 1;
            }
        }
        return $clicksGrouped;
    }

    public function getChartAttribute()
    {
        $labels = [];
        $data = [];
        $visitorsData = $this->visits()
            ->select(\DB::raw('*, HOUR(created_at) as hour'))
            ->whereDate('created_at', Carbon::today())
            ->get()
            ->groupBy('hour')
            ->map(function ($visits) {
                return $visits->count();
            })
            ->toArray();
        $viewsData = $this->linkClicks()
            ->select(\DB::raw('*, HOUR(created_at) as hour'))
            ->whereDate('created_at', Carbon::today())
            ->get()
            ->groupBy('hour')
            ->map(function ($clicks) {
                return $clicks->count();
            })
            ->toArray();
        for ($i = 0; $i <= 22; $i += 2) {
            $labels[] = $i . ':00';
            try {
                $viewsDataArray[] = $viewsData[$i] + $viewsData[$i + 1];
                $visitorsDataArray[] = $visitorsData[$i] + $visitorsData[$i + 1];
            } catch (\Exception) {
                $viewsDataArray[] = $viewsData[$i] ?? 0;
                $visitorsDataArray[] = $visitorsData[$i] ?? 0;
            }
        }
        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Views',
                    'backgroundColor' => '#8B5DCF',
                    'data' => $viewsDataArray
                ],
                [
                    'label' => 'Visitors',
                    'backgroundColor' => '#E5408A',
                    'data' => $visitorsDataArray
                ],
            ]
        ];
    }

    public function getVisitsGroupedAttribute(): array
    {
        $visits = $this->visits;
        $visitsGrouped = [];
        foreach ($visits as $visit) {
            if (isset($visitsGrouped[$visit['source']])) {
                ++$visitsGrouped[$visit['source']];
            } else {
                $visitsGrouped[$visit['source']] = 1;
            }
        }
        return $visitsGrouped;
    }
}
