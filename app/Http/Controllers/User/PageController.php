<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pages\SettingsRequest;
use App\Models\Page\LinkClick;
use App\Models\Page\Page;
use App\Models\Page\PageSeo;
use App\Models\Page\Visit;
use App\Models\Theme;
use App\Services\Chart\AbstractStats;
use App\Services\Chart\DayStats;
use App\Services\Chart\MonthStats;
use App\Services\Chart\WeekStats;
use App\Services\Chart\YearStats;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return inertia('User/Pages', ['pages' => $user->pages, 'canCreateMore' => $user->canCreateMorePages()]);
    }

    public function show($url, Request $request)
    {
        if (strlen($url) > 6) {
            $page = Page::where(['uuid' => $url])->firstOrFail();
            return redirect()->route('created-landing', ['url' => $page->link]);
        }
        $page = Page::where(['link' => $url])->firstOrFail();
        if (!$page->user_id) {
            if (!auth()->check()) {
                return redirect()->route('sign-up')->with('flashContent', $page->uuid);
            }
            $page->update(['user_id' => auth()->id()]);
            return $this->edit($page, $request);
        }
        Visit::create(['page_id' => $page->id, 'source' => $_SERVER['HTTP_REFERER'] ?? "Direct"]);
        return inertia('CreatedLanding', [
            'page' => $page,
            'is_pro' => $page->user->is_pro
        ]);
    }

    public function registerLinkClick(Request $request)
    {
        LinkClick::create([
            'page_id' => Page::firstWhere(['link' => $request->link])->id,
            'link_name' => $request->link_name
        ]);
    }

    public function store()
    {
        abort_unless(auth()->user()->canCreateMorePages(), 401);
        $page = auth()->user()->pages()->create(['uuid' => \Str::uuid(), 'link' => \Str::random(6)]);
        return Inertia::location(route('pages.edit', $page->uuid));
    }

    public function edit(Page $page, Request $request)
    {
        $stats = new DayStats($page);
        if (auth()->user()->is_pro) {
            switch ($request->period) {
                case AbstractStats::DAY_STATS:
                    break;
                case AbstractStats::WEEK_STATS:
                    $stats = new WeekStats($page);
                    break;
                case AbstractStats::MONTH_STATS:
                    $stats = new MonthStats($page);
                    break;
                case AbstractStats::YEAR_STATS:
                    $stats = new YearStats($page);
                    break;
            }
        }
        $counts = $stats->getStats();
        return inertia('User/Editor', [
            'page' => $page,
            'chart' => $stats->getChart(),
            'visits' => $counts[0],
            'link_clicks' => $counts[1],
            'themes' => Theme::where('user_id', auth()->id())->orWhere(['user_id' => null])->orderBy('key')->get(),
            'user_products' => auth()->user()->products
        ]);
    }

    public function updateSettings(SettingsRequest $request, Page $page)
    {
        $page->update($request->only('name', 'link', 'hide_logo'));
        $trackingIds = ['facebook_pixel_id', 'google_analytics_tracking_id', 'yandex_metrika_id', 'tik_tok_pixel_id'];
        $page->pageTracking->update($request->only(...$trackingIds));
        $seo = $page->pageSeo;
        $seo->update($request->only('title', 'description'));
        if ($request->favicon) {
            $seo->clearMediaCollection(PageSeo::$faviconCollection);
            $seo
                ->addMediaFromBase64($request->favicon)
                ->usingFileName(\Str::random(12) . '.jpg')
                ->toMediaCollection(PageSeo::$faviconCollection);
        }
        return redirect()->back();
    }

    public function deleteSeoFavicon(Page $page)
    {
        $page->pageSeo->clearMediaCollection(PageSeo::$faviconCollection);
        return redirect()->back();
    }

    public function updateTheme(Request $request, Page $page)
    {
        $themeId = Theme::where(['key' => $request->theme_key])->valueOrFail('id');
        $page->theme()->sync($themeId);
        return redirect()->back();
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('pages.index');
    }
}
