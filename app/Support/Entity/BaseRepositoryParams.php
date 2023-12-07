<?php

namespace App\Support\Entity;

abstract class BaseRepositoryParams extends Entity
{
    public function toAttrs(): array
    {
        $this->validate();
        return parent::toArray();
    }

    abstract public function validate(): void;
}
