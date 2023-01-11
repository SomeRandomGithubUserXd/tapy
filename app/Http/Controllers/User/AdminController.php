<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Page\Page;

class AdminController extends Controller
{
    public function index()
    {
        return inertia('User/Admin');
    }

    public function createPage()
    {
        Page::create(['uuid' => $uuid = \Str::uuid(), 'link' => \Str::random(6)]);
        return redirect()->back()->with('flashContent', $uuid);
    }
}
