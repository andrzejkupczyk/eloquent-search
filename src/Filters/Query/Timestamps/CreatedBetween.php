<?php

namespace WebGarden\Search\Filters\Query\Timestamps;

use Illuminate\Database\Eloquent\Model;
use WebGarden\Search\Filters\Query\Criteria\WhereBetween;

class CreatedBetween extends WhereBetween
{
    public function __construct(\DateTime ...$values)
    {
        parent::__construct(Model::CREATED_AT, $values);
    }
}
