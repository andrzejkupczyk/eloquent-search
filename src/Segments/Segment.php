<?php

namespace WebGarden\Search\Segments;

use WebGarden\Search\Contracts\Filtering\QueryFilter;
use WebGarden\Search\Contracts\Filtering\Segment as SegmentInterface;

class Segment implements SegmentInterface
{
    /** @var QueryFilter[] */
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = array_filter($filters, [$this, 'validateFilter']);
    }

    /**
     * {@inheritDoc}
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
