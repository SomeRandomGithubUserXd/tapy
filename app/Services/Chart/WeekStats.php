<?php

namespace App\Services\Chart;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class WeekStats extends AbstractStats
{
    protected function getEntityWithQueryMutation(HasMany $query): HasMany
    {
        return $query->select(\DB::raw('*, DAY(created_at) as ' . self::$groupByKey));
    }

    protected function getEntityLimitedWithTimePeriod(HasMany $query): HasMany
    {
        return $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()]);
    }

    protected function getIterationStart(): int
    {
        return (int)Carbon::now()->startOfWeek()->format('d');
    }

    protected function getIterationEnd(): int
    {
        return (int)Carbon::now()->format('d');
    }

    protected function getLabelOnIteration(int $i): string
    {
        $now = Carbon::now();
        return Carbon::createFromFormat('m/d/Y', $now->month . '/' . $i . '/' . $now->year)->format('l, d');
    }
}
