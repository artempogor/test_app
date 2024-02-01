<?php

namespace App\Pattern\PropertyContainer;

use Exception;

/**
 * Class PropertyContainer
 *
 * @package App\Pattern\PropertyContainer
 *
 * @url https://ru.wikipedia.org/wiki/%D0%9A%D0%BE%D0%BD%D1%82%D0%B5%D0%B9%D0%BD%D0%B5%D1%80_%D1%81%D0%B2%D0%BE%D0%B9%D1%81%D1%82%D0%B2_(%D1%88%D0%B0%D0%B1%D0%BB%D0%BE%D0%BD_%D0%BF%D1%80%D0%BE%D0%B5%D0%BA%D1%82%D0%B8%D1%80%D0%BE%D0%B2%D0%B0%D0%BD%D0%B8%D1%8F)
 */
class PropertyContainer implements PropertyContainerInterface
{
    /**
     * @var array
     */
    private array $propertyContainer;


    /**
     * @inheritdoc
     */
    public function getProperty($property): mixed
    {
        return $this->propertyContainer[$property] ?? null;
    }

    /**
     * @inheritdoc
     */
    public function addProperty($property, $value): void
    {
        $this->propertyContainer[$property] = $value;
    }

    /**
     * @inheritdoc
     * @throws Exception
     */
    public function editProperty($property, $value): void
    {
        if (!isset($this->propertyContainer[$property])) {
            throw new \RuntimeException("Нет свойства [{$property}]");
        }
        $this->propertyContainer[$property] = $value;
    }

    /**
     * @inheritdoc
     */
    public function deleteProperty($property): void
    {
        unset($this->propertyContainer[$property]);
    }
}