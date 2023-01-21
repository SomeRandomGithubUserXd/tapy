<?php

namespace App\Observers;

use App\Models\Page\PageElement;

class PageElementObserver
{
    public function created(PageElement $pageElement)
    {
        $pageElement->page->update(['updated_at' => now()]);
    }

    public function updated(PageElement $pageElement)
    {
    }

    public function deleted(PageElement $pageElement)
    {
    }

    public function restored(PageElement $pageElement)
    {
    }

    public function forceDeleted(PageElement $pageElement)
    {
    }
}
