<?php

namespace WebGarden\Search\Contracts\Filtering;

interface Segment
{
    /**
     * @return QueryFilter[]
     */
    public function filters(): array;
}
