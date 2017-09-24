<?php

namespace WebGarden\Search\Filters\Query\Criteria;

use Illuminate\Database\Eloquent\Builder;
use WebGarden\Search\Filters\Query\Filter;

/**
 * Add a where between statement to the query.
 *
 * @property string $column
 * @property array  $values
 * @property string $boolean
 * @property bool   $not
 */
class WhereBetween extends Filter
{
    public function __construct(string $column, array $values, string $boolean = 'and', bool $not = false)
    {
        parent::__construct(compact('column', 'values', 'boolean', 'not'));
    }

    /**
     * {@inheritDoc}
     */
    public function apply(Builder $query, \Closure $next): Builder
    {
        $query->whereBetween($this->column, $this->values, $this->boolean, $this->not);

        return $next($query);
    }
}
