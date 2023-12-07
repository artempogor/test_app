<?php

namespace App\Services\Post;

use App\Models\Post;
use App\Repositories\PostRepository;
use App\Services\Post\Params\PostCreateServiceParams;
use App\Services\Post\Responses\PostResponse;

class PostCreateService
{
    public function __construct(
        protected readonly PostRepository $postRepository,
    )
    {
    }

    public function create(PostCreateServiceParams $params): PostResponse
    {
        /** @var Post $item */
        $item = $this->postRepository->create($params->toRepositoryParams());

        return new PostResponse($item);
    }
}