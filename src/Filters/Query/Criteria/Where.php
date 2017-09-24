<?php

namespace WebGarden\Search\Filters\Query\Criteria;

use Illuminate\Database\Eloquent\Builder;
use WebGarden\Search\Filters\Query\Filter;

/**
 * Add a basic where clause to the query.
 *
 * @property string|array|\Closure $column
 * @property string                $operator
 * @property mixed                 $value
 * @property string                $boolean
 */
class Where extends Filter
{
    public function __construct($column, string $operator = null, $value = null, string $boolean = 'and')
    {
        parent::__construct(compact('column', 'operator', 'value', 'boolean'));
    }

    /**
     * {@inheritDoc}
     */
    public function apply(Builder $query, \Closure $next): Builder
    {
        $query->where($this->column, $this->operator, $this->value, $this->boolean);

        return $next($query);
    }
}
