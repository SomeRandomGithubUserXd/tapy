<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserDomain;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return inertia('User/Settings', [
            'domains' => auth()->user()->domains
        ]);
    }

    public function addDomain(Request $request)
    {
        if ($request->domain && !auth()->user()->domains()->where(['domain' => $request->domain])->exists()) {
            auth()->user()->domains()->create(['domain' => $request->domain]);
        }
        return redirect()->back();
    }

    public function deleteDomain($domain)
    {
        $domain = UserDomain::find($domain);
        abort_if($domain->user_id !== auth()->id(), 401);
        $domain->delete();
        return redirect()->back();
    }
}
