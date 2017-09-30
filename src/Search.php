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

    public function __construct(Builder $query, Hub $hub = null)
    {
        $this->query = $query;

        /** @noinspection PhpUndefinedMethodInspection */
        $this->hub = $hub ?: App::make(Hub::class)->defaults($this->defaultPipeline());
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
        return $this->hub->pipe($segment);
    }

    /**
     * Get a closure that configures the default pipeline.
     *
     * @return \Closure
     */
    public function defaultPipeline(): \Closure
    {
        return function (Pipeline $pipeline, Segment $segment) {
            return $pipeline->send($this->query)
                ->via('apply')
                ->through($segment->filters())
                ->then(\Closure::fromCallable([$this, 'fetch']));
        };
    }

    /**
     * Execute the query and fetch results.
     *
     * @param  Builder $query
     *
     * @return Collection
     */
    protected function fetch(Builder $query): Collection
    {
        return $query->get();
    }
}
