<?php


namespace App\Support\Entity;


use Illuminate\Database\Eloquent\Model;

trait HasStaticModel
{

    /**
     * @var Model
     */
    protected $model;

    protected static string $modelClass;

    /**
     * @param array $attributes
     * @return Model
     */
    public function newModel(array $attributes = []): Model
    {
        if (!$this->model) {
            if (!static::$modelClass) {
                throw new \RuntimeException('Model class doesn\'t init in ' . __CLASS__);
            }
            $this->model = new static::$modelClass($attributes);
        }
        return $this->model;
    }

}