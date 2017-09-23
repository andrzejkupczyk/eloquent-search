<?php

namespace WebGarden\Search;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\App;

class Search
{
    /** @var Pipeline */
    protected $pipeline;

    /** @var Builder */
    protected $query;

    public static function usingModel(Model $model)
    {
        return new self($model->newQuery());
    }

    public function __construct(Builder $query)
    {
        $this->pipeline = App::make(Pipeline::class);
        $this->query = $query;
    }

    public function apply(array $filters = []): Collection
    {
        return $this->pipeline->send($this->query)
            ->via('apply')
            ->through($filters)
            ->then(\Closure::fromCallable([$this, 'fetch']));
    }

    protected function fetch(Builder $query): Collection
    {
        return $query->get();
    }
}
