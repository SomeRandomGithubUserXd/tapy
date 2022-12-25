<?php

namespace App\Services\Chart;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class DayStats extends AbstractStats
{
    protected function getEntityWithQueryMutation(HasMany $query): HasMany
    {
        return $query->select(\DB::raw('*, HOUR(created_at) as ' . self::$groupByKey));
    }

    protected function getEntityLimitedWithTimePeriod(HasMany $query): HasMany
    {
        return $query->whereDate('created_at', Carbon::today());
    }

    protected function getIterationStart(): int
    {
        return 0;
    }

    protected function getIterationEnd(): int
    {
        return 24;
    }

    protected function getLabelOnIteration(int $i): string
    {
        return $i . ':00';
    }
}
