<?php

namespace App\Services\Post;

use App\Models\Post;
use App\Repositories\PostRepository;
use App\Services\Post\Params\PostUpdateServiceParams;
use App\Services\Post\Responses\PostResponse;

class PostUpdateService
{
    public function __construct(
        protected readonly PostRepository $postRepository,
    )
    {
    }

    public function update(PostUpdateServiceParams $params): PostResponse
    {
        /** @var Post $item */
        $item = $this->postRepository->update($params->toRepositoryParams());

        return new PostResponse($item);
    }
}