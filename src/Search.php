<?php

namespace WebGarden\Search;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\App;
use WebGarden\Search\Contracts\Filtering\Segment;

class Search
{
    /** @var Pipeline */
    protected $pipeline;

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

    public function __construct(Builder $query, Pipeline $pipeline = null)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $this->pipeline = $pipeline ?: App::make(Pipeline::class);
        $this->query = $query;
    }

    /**
     * Send given filters through a pipeline and get search results.
     *
     * @param  Segment $segment
     *
     * @return Collection
     */
    public function apply(Segment $segment): Collection
    {
        return $this->pipeline->send($this->query)
            ->via('apply')
            ->through($segment->filters())
            ->then(\Closure::fromCallable([$this, 'fetch']));
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
