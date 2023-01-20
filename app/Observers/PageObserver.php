<?php

namespace App\Observers;

use App\Models\Page\Page;
use App\Models\Theme;
use Database\Seeders\ThemeSeeder;

class PageObserver
{
    public function created(Page $page)
    {
        $page->pageTracking()->create();
        $page->pageSeo()->create();
        $defaultThemeId = 1;
        $page->theme()->attach($defaultThemeId);
        $page->pageElements()->create([
            'component_alias' => 'profile',
            'props' => [
                'username' => '@username',
                'caption' => '',
                'position' => 'center',
                'picture' => asset('placeholders/logo.svg')
            ],
            'order_column' => 0
        ]);
    }

    public function updated(Page $page)
    {
    }

    public function deleted(Page $page)
    {
    }

    public function restored(Page $page)
    {
    }

    public function forceDeleted(Page $page)
    {
    }
}
