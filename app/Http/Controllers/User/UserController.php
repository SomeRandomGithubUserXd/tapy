<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Page\PageElement;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function sendFeedback()
    {

    }

    public function uploadTempImage(Request $request)
    {
        return redirect()->back()->with('flashContent', auth()->user()
            ->addMediaFromRequest('file')
            ->usingFileName(\Str::random(12) . '.jpg')
            ->toMediaCollection(User::$tempImagesCollection)
            ->getUrl());
    }
}
