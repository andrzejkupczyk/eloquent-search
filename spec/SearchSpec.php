<?php

namespace spec\WebGarden\Search;

use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade;
use PhpSpec\ObjectBehavior;
use WebGarden\Search\Search;

class SearchSpec extends ObjectBehavior
{
    function let()
    {
        $app = new Container();
        $app->singleton('app', Container::class);

        Facade::setFacadeApplication($app);
    }

    function it_is_initializable(Builder $query)
    {
        $this->beConstructedWith($query);

        $this->shouldHaveType(Search::class);
    }

    function it_can_be_initialized_using_model(Model $model, Builder $query)
    {
        $model->newQuery()->willReturn($query)->shouldBeCalled();

        $this->beConstructedThrough('usingModel', [$model]);

        $this->shouldBeAnInstanceOf(Search::class);
    }
}
