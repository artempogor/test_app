<?php

namespace App\Pattern\PropertyContainer;

interface PropertyContainerInterface
{
    /**
     * @param $property
     * @return mixed
     */
    public function getProperty($property): mixed;

    /**
     * @param $property
     * @param $value
     * @return void
     */
    public function addProperty($property, $value): void;

    /**
     * @param $property
     * @param $value
     * @return void
     */
    public function editProperty($property, $value): void;

    /**
     * @param $property
     * @return void
     */
    public function deleteProperty($property): void;


}