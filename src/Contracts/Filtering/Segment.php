<?php

namespace WebGarden\Search\Contracts\Filtering;

interface Segment
{
    /**
     * Get filters assigned to the segment.
     */
    public function filters(): array;
}
