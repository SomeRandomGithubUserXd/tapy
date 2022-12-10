<?php

namespace App\Http\Controllers\User\Page;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pages\PageElements\UpdateProfileElementRequest;
use App\Models\Page\Page;
use App\Models\Page\PageElement;
use App\Models\Product;
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

    public function createImageElement(Page $page, UpdateProfileElementRequest $request)
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
                'component_alias' => 'image',
                'order_column' => $order,
                'props' => $request->props
            ]);
        $data = $request->only('view', 'rounded', 'square', 'zoom', 'caption');
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

    public function createImageGalleryElement(Page $page, Request $request, $id = null, $clear = true)
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
                'id' => $id,
                'component_alias' => 'image_gallery',
                'order_column' => $order,
                'props' => ['images' => []]
            ]);
        $data = [];
        $i = 0;
        foreach ($request->props as $photo) {
            if ($clear) $pageElement->clearMediaCollection(PageElement::$profilePicCollection);
            $media = $pageElement
                ->addMediaFromBase64($photo['file'])
                ->usingFileName(\Str::random(12) . '.jpg')
                ->setOrder($i)
                ->toMediaCollection(PageElement::$profilePicCollection);
            $data['images'][] = $media->getUrl();
            $i++;
        }
        $pageElement->updateProps(array_replace($pageElement->props, $data));
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
        $data = $request->only(array_keys(ElementService::getAliasProps()[$request->alias]));
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

    public function createContactElement(Page $page, UpdateProfileElementRequest $request)
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

    public function updateContactElement(PageElement $pageElement, Request $request)
    {
        $data = $request->only(array_keys(ElementService::getAliasProps()[$request->alias]));
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

    public function updateImageElement(PageElement $pageElement, Request $request)
    {
        $data = $request->only(array_keys(ElementService::getAliasProps()["image"]));
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

    public function updateImageGalleryElement(PageElement $pageElement, Request $request)
    {
        $id = $pageElement->id;
        $page = Page::find($pageElement->page_id);
        $pageElement->delete();
        $this->createImageGalleryElement($page, $request, $id, false);
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
