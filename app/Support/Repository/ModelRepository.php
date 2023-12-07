<?php


namespace App\Support\Repository;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface ModelRepository
{

    /**
     * @return Builder
     */
    public function newQuery(): Builder;

    /**
     * @param array $attributes
     * @return Model
     */
    public function newModel(array $attributes = []): Model;

}
