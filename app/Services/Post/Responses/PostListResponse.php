<?php

namespace App\Services\Post\Responses;

use Illuminate\Database\Eloquent\Collection;

class PostListResponse
{
    private Collection $items;

    /**
     * @param Collection $items
     */
    public function __construct(Collection $items)
    {
        $this->items = $items;
    }

    /**
     * @return Collection
     */
    public function getItems(): Collection
    {
        return $this->items;
    }
}