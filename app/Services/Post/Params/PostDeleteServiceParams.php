<?php

namespace App\Services\Post\Params;

use App\Repositories\Params\Post\PostDeleteRepositoryParams;

class PostDeleteServiceParams
{
    public function __construct(
        public readonly int $postId,
    )
    {
    }

    public function toRepositoryParams(): PostDeleteRepositoryParams
    {
        return new PostDeleteRepositoryParams([
            'id' => $this->postId,
        ]);
    }
}