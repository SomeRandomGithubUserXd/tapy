<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\ProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return inertia('User/Products', ['products' => auth()->user()->products]);
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        unset($data['photos']);
        $product = auth()->user()->products()->create($data);
        $i = 0;
        foreach ($request->photos as $photo) {
            $product
                ->addMediaFromBase64($photo['file'])
                ->usingFileName(\Str::random(12).'.jpg')
                ->setOrder($i)
                ->toMediaCollection(Product::$photosMediaCollection);
            $i++;
        }
        return redirect()->back();
    }

    public function update(ProductRequest $request, Product $product)
    {
        abort_if(auth()->id() !== $product->user_id, 401);
        $data = $request->validated();
        unset($data['photos']);
        $product->update($data);
        $product->clearMediaCollection(Product::$photosMediaCollection);
        $i = 0;
        foreach ($request->photos as $photo) {
            $product
                ->addMediaFromBase64($photo['file'])
                ->usingFileName(\Str::random(12).'.jpg')
                ->setOrder($i)
                ->toMediaCollection(Product::$photosMediaCollection);
            $i++;
        }
        return redirect()->back();
    }

    public function destroy(Product $product)
    {
        abort_if(auth()->id() !== $product->user_id, 401);
        $product->delete();
        return redirect()->back();
    }
}
