<?php


namespace Tests\Factories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BaseFactory
{
    /**
     * Count of models to create
     * @var int
     */
    protected $count = 1;

    /**
     * @param Collection $collection
     * @return Collection|Model
     */
    protected function collectionOrModel(Collection $collection)
    {
        return $collection->count() > 1 ? $collection : $collection->first();
    }
}