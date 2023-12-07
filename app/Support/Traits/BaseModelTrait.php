<?php

namespace App\Support\Traits;

use Illuminate\Database\Eloquent\Model;

/**
 * @method int getKey() Чтобы phpstan отлавливал ошибки типов
 */
trait BaseModelTrait
{
    /**
     * @var Model[]
     */
    protected static array $modelInstances = [];

    /**
     * @return string
     */
    public static function getStaticTable(): string
    {
        return static::modelInstance()->getTable();
    }

    /**
     * @return Model
     */
    public static function modelInstance(): Model
    {
        if (!isset(static::$modelInstances[static::class])) {
            static::$modelInstances[static::class] = new static(); // @phpstan-ignore-line
        }
        return static::$modelInstances[static::class];
    }

    /**
     * @return string
     */
    public static function getStaticKeyName(): string
    {
        return static::modelInstance()->getKeyName();
    }

    /**
     * @return string
     */
    public static function getStaticQualifiedKeyName(): string
    {
        return static::modelInstance()->getQualifiedKeyName();
    }

    /**
     * @return string
     */
    public static function getStaticMorphClass(): string
    {
        return static::modelInstance()->getMorphClass();
    }
}
