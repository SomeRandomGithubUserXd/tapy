<?php

namespace App\Services\Chart;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class YearStats extends AbstractStats
{
    protected function getEntityWithQueryMutation(HasMany $query): HasMany
    {
        return $query->select(\DB::raw('*, MONTH(created_at) as ' . self::$groupByKey));
    }

    protected function getEntityLimitedWithTimePeriod(HasMany $query): HasMany
    {
        return $query->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()]);
    }

    protected function getIterationStart(): int
    {
        return (int)Carbon::now()->startOfYear()->format('m');
    }

    protected function getIterationEnd(): int
    {
        return (int)Carbon::now()->format('m');
    }

    protected function getLabelOnIteration(int $i): string
    {
        return Carbon::createFromFormat('m/d/Y', $i . '/01/' . Carbon::now()->year)->format('Y, M');
    }
}
