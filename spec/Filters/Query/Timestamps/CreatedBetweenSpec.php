<?php

namespace spec\WebGarden\Search\Filters\Query\Timestamps;

use Illuminate\Database\Eloquent\Model;
use PhpSpec\ObjectBehavior;
use WebGarden\Search\Filters\Query\Criteria\WhereBetween;
use WebGarden\Search\Filters\Query\Timestamps\CreatedBetween;

class CreatedBetweenSpec extends ObjectBehavior
{
    function it_is_initializable(\DateTime $dateTime)
    {
        $this->beConstructedWith($dateTime, $dateTime);

        $this->shouldHaveType(CreatedBetween::class);
        $this->shouldBeAnInstanceOf(WhereBetween::class);
    }

    function it_returns_filter_parameters(\DateTime $dateTime)
    {
        $dates = [$dateTime, $dateTime];

        $this->beConstructedWith(...$dates);

        $this->column->shouldBe(Model::CREATED_AT);
        $this->values->shouldBe($dates);
    }
}
