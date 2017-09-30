<?php

namespace WebGarden\Search\Segments;

use WebGarden\Search\Contracts\Filtering\QueryFilter;
use WebGarden\Search\Contracts\Filtering\Segment as SegmentInterface;

class Segment implements SegmentInterface
{
    /** @var QueryFilter[] */
    protected $filters;

    public function __construct(array $filters)
    {
        if (!$filters = array_filter($filters, [$this, 'validateFilter'])) {
            throw new \InvalidArgumentException('The segment must contain at least one valid filter.');
        }

        $this->filters = $filters;
    }

    /**
     * @return QueryFilter[]
     */
    public function filters(): array
    {
        return $this->filters;
    }

    protected function validateFilter($filter): bool
    {
        return $filter instanceof QueryFilter;
    }
}
