<?php

namespace spec\WebGarden\Search\Filters\Query\Timestamps;

use Illuminate\Database\Eloquent\Model;
use PhpSpec\ObjectBehavior;
use WebGarden\Search\Filters\Query\Criteria\WhereBetween;
use WebGarden\Search\Filters\Query\Timestamps\CreatedBetween;

class CreatedBetweenSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(new \DateTime, new \DateTime);

        $this->shouldHaveType(CreatedBetween::class);
        $this->shouldBeAnInstanceOf(WhereBetween::class);
    }

    function it_returns_filter_parameters()
    {
        $dates = [new \DateTime, new \DateTime];

        $this->beConstructedWith(...$dates);

        $this->column->shouldBe(Model::CREATED_AT);
        $this->values->shouldBe($dates);
    }
}
