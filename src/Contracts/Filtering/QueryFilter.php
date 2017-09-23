<?php

namespace WebGarden\Search\Contracts\Filtering;

use Closure;
use Illuminate\Database\Eloquent\Builder;

interface QueryFilter
{
    public function apply(Builder $query, Closure $next): Builder;
}
