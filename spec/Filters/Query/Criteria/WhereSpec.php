<?php

namespace spec\WebGarden\Search\Filters\Query\Criteria;

use PhpSpec\ObjectBehavior;
use WebGarden\Search\Filters\Query\Criteria\Where;
use WebGarden\Search\Filters\Query\Filter;

class WhereSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('foo');

        $this->shouldHaveType(Where::class);
        $this->shouldBeAnInstanceOf(Filter::class);
    }

    function it_returns_filter_parameters()
    {
        $this->beConstructedWith('foo', '=', 'bar', 'or');

        $this->column->shouldBe('foo');
        $this->operator->shouldBe('=');
        $this->value->shouldBe('bar');
        $this->boolean->shouldBe('or');
    }

    function it_uses_default_parameters_values()
    {
        $this->beConstructedWith('foo');

        $this->operator->shouldBeNull();
        $this->value->shouldBeNull();
        $this->boolean->shouldBe('and');
    }
}
