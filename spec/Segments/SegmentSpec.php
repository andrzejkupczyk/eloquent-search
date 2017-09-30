<?php

namespace spec\WebGarden\Search\Segments;

use PhpSpec\ObjectBehavior;
use WebGarden\Search\Contracts\Filtering\QueryFilter;
use WebGarden\Search\Segments\Segment;

class SegmentSpec extends ObjectBehavior
{
    function it_is_initializable(QueryFilter $validFilter)
    {
        $this->beConstructedWith([$validFilter]);

        $this->shouldHaveType(Segment::class);
    }

    function it_ignores_invalid_filters(QueryFilter $validFilter)
    {
        $this->beConstructedWith([$validFilter, QueryFilter::class, new \stdClass]);

        $this->filters()->shouldBe([$validFilter]);
    }

    function it_throws_exception_when_no_valid_filter_is_provided(\stdClass $invalidFilter)
    {
        $this->beConstructedWith([$invalidFilter]);

        $this->shouldThrow(\InvalidArgumentException::class)->duringInstantiation();
    }
}
