<?php

namespace App\Http\Controllers\User\Page;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pages\PageElements\UpdateProfileElementRequest;
use App\Models\Page\Page;
use App\Models\Page\PageElement;
use App\Services\ElementService;
use Illuminate\Http\Request;

class ElementController extends Controller
{
    public function create(Page $page, Request $request)
    {
        try {
            $order = PageElement::query()
                    ->where(['page_id' => $page->id])
                    ->orderByDesc('order_column')
                    ->first()
                    ->order_column + 1;
        } catch (\Exception) {
            $order = 0;
        }
        $page
            ->pageElements()
            ->create([
                'component_alias' => $request->alias,
                'order_column' => $order,
                'props' => $request->props
            ]);
        return redirect()->back();
    }

    public function createProfileElement(Page $page, UpdateProfileElementRequest $request)
    {
        try {
            $order = PageElement::query()
                    ->where(['page_id' => $page->id])
                    ->orderByDesc('order_column')
                    ->first()
                    ->order_column + 1;
        } catch (\Exception) {
            $order = 0;
        }
        $pageElement = $page
            ->pageElements()
            ->create([
                'component_alias' => $request->alias,
                'order_column' => $order,
                'props' => $request->props
            ]);
        $data = $request->only('caption', 'username', 'position');
        if ($request->file('picture')) {
            $pageElement->clearMediaCollection(PageElement::$profilePicCollection);
            $media = $pageElement
                ->addMediaFromRequest('picture')
                ->usingFileName(\Str::random(12) . '.jpg')
                ->toMediaCollection(PageElement::$profilePicCollection);
            $data['picture'] = $media->getUrl();
        }
        $pageElement->updateProps(array_replace($pageElement->props, $data));
        return redirect()->back();
    }


    public function updateProfileElement(PageElement $pageElement, UpdateProfileElementRequest $request)
    {
        $data = $request->only('caption', 'username', 'position');
        if ($request->file('picture')) {
            $pageElement->clearMediaCollection(PageElement::$profilePicCollection);
            $media = $pageElement
                ->addMediaFromRequest('picture')
                ->usingFileName(\Str::random(12) . '.jpg')
                ->toMediaCollection(PageElement::$profilePicCollection);
            $data['picture'] = $media->getUrl();
        }
        $pageElement->updateProps(array_replace($pageElement->props, $data));
        return redirect()->back();
    }

    public function updateStatic(Request $request, PageElement $pageElement)
    {
        $data = $request->only(array_keys(ElementService::getAliasProps()[$request->alias]));
        $pageElement->updateProps(array_replace($pageElement->props, $data));
        return redirect()->back();
    }

    public function removeProfilePicture(PageElement $pageElement)
    {
        $pageElement->clearMediaCollection(PageElement::$profilePicCollection);
        $pageElement->updateProps([
            ...$pageElement->props,
            'picture' => null
        ]);
        return redirect()->back();
    }

    public function reorder(Page $page, Request $request)
    {
        foreach ($request->objects as $key => $object) {
            $page->pageElements()
                ->where(['id' => $object['id']])
                ->update(['order_column' => $key]);
        }
        return response()->json('Success');
    }

    public function copy(PageElement $pageElement, Request $request)
    {
        $page = Page::firstWhere(['uuid' => $request->pageId]);
        abort_if($page->user_id !== auth()->id(), 401);
        $page->pageElements()->create($pageElement->toArray());
        return redirect()->back();
    }

    public function destroy(PageElement $pageElement)
    {
        $pageElement->delete();
        return redirect()->back();
    }
}
