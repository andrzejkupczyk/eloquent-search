<?php

namespace WebGarden\Search\Filters\Query;

use WebGarden\Search\Contracts\Filtering\QueryFilter;

abstract class Filter implements QueryFilter
{
    /** @var array */
    protected $parameters;

    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }
}
