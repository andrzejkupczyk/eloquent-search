<?php

namespace WebGarden\Search;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Hub;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\App;
use WebGarden\Search\Contracts\Filtering\Segment;

class Search
{
    /** @var Hub */
    protected $hub;

    /** @var Builder */
    protected $query;

    /**
     * Create a new Search object using a given model.
     *
     * @param  Model $model
     *
     * @return Search
     */
    public static function usingModel(Model $model)
    {
        return new self($model->newQuery());
    }

    public function __construct(Builder $query)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $this->hub = App::make(Hub::class);
        $this->hub->defaults($this->filterPipeline());

        $this->query = $query;
    }

    /**
     * Send given filters through a pipeline and get the search results.
     *
     * @param  Segment $segment
     *
     * @return Collection
     */
    public function apply(Segment $segment): Collection
    {
        /** @var Builder $query */
        $query = $this->hub->pipe($segment);

        return $query->get();
    }

    /**
     * Get clone of the original query builder.
     */
    public function query(): Builder
    {
        return clone $this->query;
    }

    /**
     * Get a closure that configures the default pipeline.
     *
     * @return \Closure
     */
    protected function filterPipeline(): \Closure
    {
        return function (Pipeline $pipeline, Segment $segment) {
            return $pipeline->send($this->query())
                ->via('apply')
                ->through($segment->filters())
                ->then(function (Builder $query) {
                    return $query;
                });
        };
    }
}
