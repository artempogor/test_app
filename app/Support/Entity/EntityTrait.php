<?php


namespace App\Support\Entity;


use Illuminate\Database\Eloquent\Concerns\HasAttributes;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Concerns\HidesAttributes;

trait EntityTrait
{

    use HidesAttributes, HasRelationships, HasAttributes {
        HasAttributes::castAttribute as parentCastAttribute;
    }

    /**
     * @param array $attributes
     */
    final public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
        $this->makeVisible($this->attributes);
    }

    /**
     * @param $attributes
     * @return $this
     */
    public function makeVisible($attributes): static
    {
        return $this;
    }

    /**
     * @param array $attrs
     * @return static
     */
    public static function newInstance(array $attrs = []): static
    {
        return new static($attrs);
    }

    public function fill(array $attributes): static
    {
        foreach ($attributes as $key => $value) {
            $this->setAttribute($key, $value);
        }

        return $this;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function hasAttribute(string $key): bool
    {
        return array_key_exists($key, $this->attributes);
    }

    /**
     * Set the value for a given offset.
     *
     * @param mixed $offset
     * @param mixed $value
     * @return void
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->setAttribute($offset, $value);
    }

    /**
     * Determine if an attribute or relation exists on the model.
     *
     * @param string $key
     * @return bool
     */
    public function __isset(string $key)
    {
        return $this->offsetExists($key);
    }

    /**
     * Determine if the given attribute exists.
     *
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return !is_null($this->getAttribute($offset));
    }

    /**
     * Unset an attribute on the model.
     *
     * @param string $key
     * @return void
     */
    public function __unset(string $key)
    {
        $this->offsetUnset($key);
    }

    /**
     * Unset the value for a given offset.
     *
     * @param mixed $offset
     * @return void
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->attributes[$offset]);
    }

    /**
     * @return false|string
     */
    public function __toString()
    {
        return $this->toJson();
    }

    /**
     * @param int $options
     * @return false|string
     */
    public function toJson($options = 0): bool|string
    {
        return json_encode($this->jsonSerialize());
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->attributesToArray();
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->offsetGet($name);
    }

    /**
     * Get the value for a given offset.
     *
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->getAttribute($offset);
    }

    /**
     * TODO подумать на оптимизацией
     * Get the attributes that should be converted to dates.
     *
     * @return array
     */
    public function getDates(): array
    {
//        $defaults = [];
//
//        return $this->usesTimestamps()
//            ? array_unique(array_merge($this->dates, $defaults))
//            : $this->dates;
        return [];
    }

    /**
     * @param $attributes
     * @return $this
     */
    public function makeHidden($attributes): static
    {
        return $this;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    protected function castAttribute($key, $value): mixed
    {
        $value = $this->parentCastAttribute($key, $value);
        $casts = $this->getCasts();
        $className = $casts[$key];

        if (class_exists($className) && !($value instanceof $className)) {
            return $this->castCustomClass($value, $className);
        }

        return $value;
    }

    /**
     * @param $value
     * @param string $class
     * @return mixed
     */
    protected function castCustomClass($value, string $class): mixed
    {
        if (is_array($value)) {
            return new $class($value);
        }

        if (is_string($value)) {
            return new $class($this->fromJson($value));
        }

        return $value;
    }

    /**
     * @param $value
     * @param bool $asObject
     * @return mixed
     */
    public function fromJson($value, $asObject = false): mixed
    {
        if (is_array($value) || is_object($value)) {
            return $asObject ? (object)$value : (array)$value;
        }

        return json_decode($value, !$asObject);
    }

    /**
     * @return bool
     */
    protected function getIncrementing(): bool
    {
        return false;
    }

}
