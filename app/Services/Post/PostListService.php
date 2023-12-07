<?php

namespace App\Services\Post;

use App\Repositories\PostRepository;
use App\Services\Post\Params\PostListServiceParams;
use App\Services\Post\Responses\PostListResponse;

class PostListService
{
    public function __construct(
        protected readonly PostRepository $postRepository,
    )
    {
    }

    public function list(PostListServiceParams $params): PostListResponse
    {
        $items = $this->postRepository->list($params->toRepositoryParams());

        return new PostListResponse($items);
    }
}