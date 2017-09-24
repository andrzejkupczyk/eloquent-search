<?php

namespace WebGarden\Search\Contracts\Filtering;

use Illuminate\Database\Eloquent\Builder;

interface QueryFilter
{
    /**
     * Apply filter parameters to the builder instance.
     *
     * @param  Builder  $query
     * @param  \Closure $next
     *
     * @return Builder
     */
    public function apply(Builder $query, \Closure $next): Builder;
}
