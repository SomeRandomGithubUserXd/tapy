<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pages\SettingsRequest;
use App\Models\Page\LinkClick;
use App\Models\Page\Page;
use App\Models\Page\PageSeo;
use App\Models\Page\Visit;
use App\Models\Theme;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function index()
    {
        return inertia('User/Pages', ['pages' => auth()->user()->pages]);
    }

    public function show(Page $page)
    {
        Visit::create(['page_id' => $page->id, 'source' => $_SERVER['HTTP_REFERER'] ?? "Direct"]);
        return inertia('CreatedLanding', [
            'page' => $page
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
        $page = auth()->user()->pages()->create(['uuid' => \Str::uuid(), 'link' => \Str::random(6)]);
        return Inertia::location(route('pages.edit', $page->uuid));
    }

    public function edit(Page $page)
    {
        return inertia('User/Editor', [
            'page' => $page->append(['visits_grouped', 'link_clicks_grouped', 'chart']),
            'themes' => Theme::orderBy('key')->get(),
            'user_products' => auth()->user()->products
        ]);
    }

    public function updateSettings(SettingsRequest $request, Page $page)
    {
        $page->update($request->only('name', 'link'));
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
