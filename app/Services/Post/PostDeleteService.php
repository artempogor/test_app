<?php

namespace App\Services\Post;

use App\Repositories\PostRepository;
use App\Services\Post\Params\PostDeleteServiceParams;

class PostDeleteService
{
    public function __construct(
        protected readonly PostRepository $postRepository,
    )
    {
    }

    public function delete(PostDeleteServiceParams $params): bool
    {
        return $this->postRepository->delete($params->toRepositoryParams());
    }
}