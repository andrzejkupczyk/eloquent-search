<?php

namespace spec\WebGarden\Search\Filters\Query\Criteria;

use PhpSpec\ObjectBehavior;
use WebGarden\Search\Filters\Query\Criteria\WhereBetween;
use WebGarden\Search\Filters\Query\Filter;

class WhereBetweenSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('foo', [1, 10]);

        $this->shouldHaveType(WhereBetween::class);
        $this->shouldBeAnInstanceOf(Filter::class);
    }

    function it_returns_filter_parameters()
    {
        $this->beConstructedWith('foo', [1, 10], 'or', true);

        $this->column->shouldBe('foo');
        $this->values->shouldBe([1, 10]);
        $this->boolean->shouldBe('or');
        $this->not->shouldBe(true);
    }

    function it_returns_default_parameters_values()
    {
        $this->beConstructedWith('foo', [1, 10]);

        $this->boolean->shouldBe('and');
        $this->not->shouldBe(false);
    }
}
