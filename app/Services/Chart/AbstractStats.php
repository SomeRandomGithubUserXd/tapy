<?php

namespace App\Services\Chart;

use App\Models\Page\Page;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

abstract class AbstractStats
{
    protected static string $groupByKey = 'group_by_key';

    public const DAY_STATS = 0;

    public const WEEK_STATS = 1;

    public const MONTH_STATS = 2;

    public const YEAR_STATS = 3;

    protected Page $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    abstract protected function getEntityWithQueryMutation(HasMany $query): HasMany;

    abstract protected function getEntityLimitedWithTimePeriod(HasMany $query): HasMany;

    abstract protected function getIterationStart(): int;

    abstract protected function getIterationEnd(): int;

    abstract protected function getLabelOnIteration(int $i): string;

    public function getChart(): array
    {
        $entities = [
            [
                'label' => 'Views',
                'backgroundColor' => '#8B5DCF',
                'query' => $this->page->visits()
            ],
            [
                'label' => 'Visitors',
                'backgroundColor' => '#E5408A',
                'query' => $this->page->linkClicks()
            ],
        ];
        $datasets = [];
        foreach ($entities as $entity) {
            $labels = [];
            $grouped = $this->getEntityWithQueryMutation($entity['query']);
            $timeLimited = $this->getEntityLimitedWithTimePeriod($grouped);
            $data = $timeLimited
                ->get()
                ->groupBy(self::$groupByKey)
                ->map(fn($items) => $items->count())
                ->toArray();
            $compiled = [];
            for ($i = $this->getIterationStart(); $i <= $this->getIterationEnd(); $i++) {
                $labels[] = $this->getLabelOnIteration($i);
                try {
                    $compiled[] = $data[$i];
                } catch (\Exception) {
                    $compiled[] = $data[$i] ?? 0;
                }
            }
            $datasets[] = [
                'label' => $entity['label'],
                'backgroundColor' => $entity['backgroundColor'],
                'data' => $compiled
            ];
        }
        return [
            'labels' => $labels,
            'datasets' => $datasets
        ];
    }

    public function getStats(): array
    {
        $entities = [
            [
                'key' => 'source',
                'query' => $this->page->visits()
            ],
            [
                'key' => 'link_name',
                'query' => $this->page->linkClicks()
            ],
        ];
        $entitiesGrouped = [];
        foreach ($entities as $entity) {
            $grouped = [];
            $items = $this->getEntityLimitedWithTimePeriod($entity['query'])->get();
            foreach ($items as $item) {
                if (isset($grouped[$item[$entity['key']]])) {
                    ++$grouped[$item[$entity['key']]];
                } else {
                    $grouped[$item[$entity['key']]] = 1;
                }
            }
            $entitiesGrouped[] = $grouped;
        }
        return $entitiesGrouped;
    }
}
