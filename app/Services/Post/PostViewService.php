<?php

namespace App\Services\Post;

use App\Models\Post;
use App\Repositories\PostRepository;
use App\Services\Post\Params\PostViewServiceParams;
use App\Services\Post\Responses\PostResponse;

class PostViewService
{
    public function __construct(
        protected readonly PostRepository $postRepository,
    )
    {
    }

    public function view(PostViewServiceParams $params): PostResponse
    {
        /** @var Post $item */
        $item = $this->postRepository->byId($params->postId);

        return new PostResponse($item);
    }
}