<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class CurrencyController extends Controller
{
    public function index()
    {
        $comesFirst = [
            1 => 'USD',
            2 => 'BYN',
            3 => 'RUB',
            4 => 'EUR',
            5 => 'UAH',
        ];
        $currencies = \DB::table('currencies')
            ->orderByRaw("`short_name` = 'RUB' AND `short_name` = 'USD' DESC")
            ->pluck('short_name')
            ->sortBy(fn($cur, $key) => array_search($cur, $comesFirst) ?: count($comesFirst) + $key);
        return response()->json($currencies->values());
    }
}
