<?php

namespace App\Support\Responses;

class BaseItemResponse
{
    public function __construct(
        protected ResponseItemInterface $item,
    )
    {
    }
    public function getItem(): ?ResponseItemInterface
    {
        return $this->item;
    }
}