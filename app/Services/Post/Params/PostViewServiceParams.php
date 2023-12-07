<?php

namespace App\Services\Post\Params;

class PostViewServiceParams
{
    public function __construct(
        public readonly int $postId,
    )
    {
    }
}