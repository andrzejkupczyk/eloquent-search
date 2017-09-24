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

    /**
     * Get a parameter's value based on its name.
     *
     * @param  string $name
     *
     * @return mixed|null
     */
    public function __get(string $name)
    {
        return $this->parameters[$name] ?? null;
    }
}
