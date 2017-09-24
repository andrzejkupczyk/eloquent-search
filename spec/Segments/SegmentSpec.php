<?php

namespace spec\WebGarden\Search\Segments;

use PhpSpec\ObjectBehavior;
use WebGarden\Search\Contracts\Filtering\QueryFilter;
use WebGarden\Search\Segments\Segment;

class SegmentSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Segment::class);
    }

    function it_returns_filters_array()
    {
        $this->filters()->shouldBeArray();
    }

    function it_ignores_invalid_filters(QueryFilter $validFilter)
    {
        $this->beConstructedWith([$validFilter, QueryFilter::class, new \stdClass]);

        $this->filters()->shouldBe([$validFilter]);
    }
}
