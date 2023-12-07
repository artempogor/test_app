<?php

namespace App\Repositories;

interface UpdateRepositoryParamsInterface
{
    public function getId(): int;

    public function toAttrs(): array;
}
