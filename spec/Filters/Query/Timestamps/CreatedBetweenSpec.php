<?php

namespace spec\WebGarden\Search\Filters\Query\Timestamps;

use PhpSpec\ObjectBehavior;
use WebGarden\Search\Filters\Query\Criteria\WhereBetween;
use WebGarden\Search\Filters\Query\Timestamps\CreatedBetween;

class CreatedBetweenSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith([1, 10]);

        $this->shouldHaveType(CreatedBetween::class);
        $this->shouldBeAnInstanceOf(WhereBetween::class);
    }
}
