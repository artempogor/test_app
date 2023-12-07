<?php


namespace App\Support\Entity;


use Illuminate\Database\Eloquent\Model;

trait HasStaticModel
{

    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param array $attributes
     * @return Model
     */
    public function newModel(array $attributes = []): Model
    {
        return $this->model;
    }

}
