<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Page\Page;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->with(['pages', 'pages.pageElements', 'pages.pageSeo', 'pages.pageTracking'])
            ->get();
        return inertia('User/Admin', [
            'users' => UserResource::collection($users),
            'users_total' => User::count()
        ]);
    }

    public function createPage()
    {
        Page::create(['uuid' => $uuid = \Str::uuid(), 'link' => \Str::random(6)]);
        return redirect()->back()->with('flashContent', $uuid);
    }

    public function blockUsers(Request $request)
    {
        $userIds = $request->userIds;
        User::whereIn('id', $userIds)->update(['is_blocked' => true]);
        return redirect()->back();
    }

    public function unblockUsers(Request $request)
    {
        $userIds = $request->userIds;
        User::whereIn('id', $userIds)->update(['is_blocked' => false]);
        return redirect()->back();
    }

    public function updatePagesLimit(User $user, Request $request)
    {
        $user->update(['pages_limit' => $request->limit]);
        return redirect()->back();
    }

    public function givePro(User $user, Request $request)
    {
        $user->update(['subscribed_until' => now()->addMonths($request->period)]);
        return redirect()->back();
    }
}
